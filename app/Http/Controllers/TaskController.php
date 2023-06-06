<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

// use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        return view('task.index');
    }
    public function create()
    {
        return view('task.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|unique:tasks|max:255',
            'description' => 'required',
            'type' => 'required',
            // 'task_number' => 'required|unique:tasks|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'categories_id' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        $newImageName = time() . '-' . 'tasks' . '.' . $request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('task'), $newImageName);

        // dd($validatedData);

        $task = new Task;
        $task->name = $validatedData['name'];
        $task->description = $validatedData['description'];
        $task->type = $validatedData['type'];
        $task->status = "Pending";
        $task->task_number = 'T' . str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
        $task->start_date = $validatedData['start_date'];
        $task->end_date = $validatedData['end_date'];
        $task->categories_id = $validatedData['categories_id'];
        $task->image_path = $newImageName;
        $task->save();

        return redirect()->back()->with('success', 'Task added successfully');
    }

    public function completeTask($id)
    {

        $statuses = DB::table('tasks AS t')
            ->join('users_has_tasks AS uht', 't.id', '=', 'uht.tasks_id')
            ->join('users AS u', 'uht.users_id', '=', 'u.id')
            ->leftJoin('reports AS r', 'uht.users_id', '=', 'r.users_id')
            ->where('t.id', $id)
            ->where('r.status', 'Done')
            ->where('u.role', '<>', 'Job Inspector')
            ->select('u.id', 'r.status', DB::raw('CASE WHEN r.status = "Done" THEN 1 ELSE 0 END AS status_done'))
            ->get();
        $users_task = DB::table('tasks AS t')
            ->join('users_has_tasks AS uht', 't.id', '=', 'uht.tasks_id')
            ->join('users AS u', 'uht.users_id', '=', 'u.id')
            ->where('t.id', $id)
            ->where('u.role', '<>', 'Job Inspector')
            ->select('t.*')
            ->get();
        // dd($users_task);
        // dd($statuses);
        // dd($users_task->count() == $statuses->sum('status_done'));
        $task = Task::find($id);
        if ($users_task->count() == $statuses->sum('status_done')) {
            $task->status = "Done";
            $task->save();
            return redirect()->back()->with('success', 'Task comlpeted successfully');
            } else {
            return redirect()->back()->withErrors('Task cannot be completed yet');
        }
    }

    public function assign_staff(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'staff' => 'required',
        ]);

        // check if staff already assigned to task
        $check = DB::table('users_has_tasks')
            ->where('users_id', $validatedData['staff'])
            ->where('tasks_id', $id)
            ->count();

        if ($check > 0) {
            // dd($check);
            return redirect()->back()->withErrors('Staff already added to this task');
        }

        // create new users_has_tasks record
        DB::table('users_has_tasks')->insert([
            'users_id' => $validatedData['staff'],
            'tasks_id' => $id,
        ]);

        return redirect()->back()->with('success', 'Staff added successfully');
    }

    public function remove_staff($tasks_id, $users_id)
    {
        // $validatedData = $request->validate([
        //     'staff' => 'required',
        //     'task_id' => 'required',
        // ]);

        // create new users_has_tasks record
        DB::table('users_has_tasks')
            ->where('users_id', $users_id)
            ->where('tasks_id', $tasks_id)
            ->delete();
        // $task->worker = $validatedData['staff'];
        // $task->save();

        return redirect()->back()->with('success', 'Staff deleted successfully');
    }

    public function add_item(Request $request, $id)
    {
        $validatedData = $request->validate([
            'item' => 'required',
            'amount' => 'required',
        ]);

        // check if staff already assigned to task
        $check = DB::table('tasks_has_items')
            ->where('items_id', $validatedData['item'])
            ->where('tasks_id', $id)
            ->count();

        // if ($check > 0) {
        //     return redirect()->back()->withErrors('Item already added to this task');
        // }

        $stock_inv = DB::table('items')
            ->where('id', $validatedData['item'])
            ->value('stock');

        // if ($stock_inv < $validatedData['amount']) {
        //     return redirect()->back()->withErrors('Stock tidak mencukupi');
        // }

        if ($validatedData['amount'] <= 0) {
            return redirect()->back()->withErrors('Invalid Amount');
        }

        if ($validatedData['amount'] == null) {
            return redirect()->back()->withErrors('Invalid Amount');
        }

        if ($check > 0) {

            DB::table('item_logs')->insert([
                'taskName' => DB::table('tasks')
                    ->where('id', $id)
                    ->value('name'),
                'itemName' => DB::table('items')
                    ->where('id', $validatedData['item'])
                    ->value('name'),
                'stock' => $validatedData['amount'],
                'status' => 'Dipakai',
            ]);

            $amount = DB::table('tasks_has_items')
                ->where('items_id', $validatedData['item'])
                ->where('tasks_id', $id)
                ->value('amount');

            $amount = $amount + $validatedData['amount'];

            DB::table('tasks_has_items')
                ->where('items_id', $validatedData['item'])
                ->where('tasks_id', $id)
                ->update(['amount' => $amount]);

            DB::table('items')
                ->where('id', $validatedData['item'])
                ->update(['stock' => $stock_inv - $validatedData['amount']]);

            return redirect()->back()->with('success', 'Item added successfully');
        }

        // update stock_inv with substract it with amount
        DB::table('items')
            ->where('id', $validatedData['item'])
            ->update(['stock' => $stock_inv - $validatedData['amount']]);

        // create new users_has_tasks record
        DB::table('tasks_has_items')->insert([
            'items_id' => $validatedData['item'],
            'tasks_id' => $id,
            'amount' => $validatedData['amount'],
        ]);

        DB::table('item_logs')->insert([
            'taskName' => DB::table('tasks')
                ->where('id', $id)
                ->value('name'),
            'itemName' => DB::table('items')
                ->where('id', $validatedData['item'])
                ->value('name'),
            'stock' => $validatedData['amount'],
            'status' => 'Dipakai',
        ]);

        return redirect()->back()->with('success', 'Item added successfully');
    }

    public function show($id)
    {
        $task = Task::find($id);
        return view('task.show', compact('task'));
    }
    public function edit($id)
    {
        $task = Task::find($id);
        return view('task.edit', compact('task'));
    }
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // dd($request->file('image_path'));
        $task = Task::find($id);

        $task->status = DB::table('tasks')
            ->where('id', $id)
            ->value('status');

        if ($task->status == "cancelled") {
            return redirect()->back()->withErrors('Task already cancelled, cannot be updated');
        }

        $task->name = $request->name;
        $task->description = $request->description;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        // $newImageName = time() . '-' . 'tasks' . '.' . $request->file('image_path')->extension();
        if ($request->hasFile('image_path')) {
            $newImageName = time() . '-' . 'tasks' . '.' . $request->file('image_path')->extension();
            $request->file('image_path')->move(public_path('task'), $newImageName);
            $task->image_path = $newImageName;
        }
        $task->save();

        // Task::whereId($id)->update($validatedData);
        return redirect()->back()->with('success', 'Task updated successfully');
    }

    public function cancel($id)
    {
        $task = Task::findOrFail($id);
        $task->status = "cancelled";
        $task->save();
        return redirect()->back()->with('success', 'Task cancelled successfully');
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->caetgories()->delete();
        return view('task.delete', compact('task'));
    }

    public function destroy($id)
    {
        $project_id = DB::table('projects')
            ->join('locations', 'locations.projects_id', '=', 'projects.id')
            ->join('categories', 'categories.locations_id', '=', 'locations.id')
            ->join('tasks', 'tasks.categories_id', '=', 'categories.id')
            ->where('tasks.id', $id)
            ->select('projects.id')
            ->first();

        DB::table('users_has_tasks')->where('tasks_id', $id)->delete();
        DB::table('tasks_has_items')->where('tasks_id', $id)->delete();
        $task = Task::findOrFail($id);
        $task->delete();

        if (auth()->user()->role == 'Admin IT')
            return redirect()->route('admin.project.detail', ['id' => $project_id->id])->with('success', 'Task deleted successfully');
        else if (auth()->user()->role == 'Supervisor')
            return redirect()->route('supervisor.project.detail', ['id' => $project_id->id])->with('success', 'Task deleted successfully');
    }

    public function delete_item($taskId, $itemId)
    {
        // Find the task
        $task = Task::find($taskId);

        // Check if the task exists
        if (!$task) {
            return redirect()->back()->withErrors('Task not found');
        }

        $jumlah = DB::table('tasks_has_items')
            ->where('items_id', $itemId)
            ->where('tasks_id', $taskId)
            ->value('amount');

        // substract stock at items table
        $stock_inv = DB::table('items')
            ->where('id', $itemId)
            ->value('stock');

        DB::table('items')
            ->where('id', $itemId)
            ->update(['stock' => $stock_inv + $jumlah]);

        DB::table('item_logs')->insert([
            'taskName' => DB::table('tasks')
                ->where('id', $taskId)
                ->value('name'),
            'itemName' => DB::table('items')
                ->where('id', $itemId)
                ->value('name'),
            'stock' => $jumlah,
            'status' => 'Dikembalikan',
        ]);

        // Find the item within the task and detach it
        $task->items()->detach($itemId);

        return redirect()->back()->with('success', 'Item deleted from task successfully');
    }
}
