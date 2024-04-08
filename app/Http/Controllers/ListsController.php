<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ListsController extends Controller
{
    public function getLists() {
        $lists = DB::table('lists')->orderBy('order', 'asc')->get();

        return response()->json($lists);
    }

    public function updateLists(Request $request) {
        $newOrder = $request->input('newOrder');

        $updates = [];
        foreach ($newOrder as $index => $itemId) {
            // Method 1: $updates[$itemId] = $index + 1;
            $updates[] = [
                'id' => $itemId,
                'order' => $index + 1
            ];
        }

        // Method 1: DB::table('lists')->update(['order' => DB::raw('FIELD(id, '.implode(',', array_keys($updates)).')')]);
        DB::table('lists')->upsert($updates, ['id'], ['order']);

        return response()->json(['success' => true]);
    }
}
