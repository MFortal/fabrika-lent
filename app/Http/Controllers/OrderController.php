<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Throwable;

class OrderController extends Controller
{
    public function index()
    {
        return 'ok';
        $data = Order::all()->orderBy('created_at')->get();

        return $data;
    }


    public function create(OrderRequest $request)
    {
        $validated = $request->validated();

        try {
            $order = new Order();
            $order->phone = $validated['phone'];
            $order->name = $validated['name'];
            $order->data = $validated['data'];
            $order->save();


            // st-test добавить отправку уведомления на email через jobs
            // $notification = Notification::create([
            //     'user_id' => $private_moderation->id,
            //     'type_notification_id' => 2,
            //     'is_read' => 0

            // ]);

            // event(new NotificationCreated($notification));
            // ** */


            return response(new OrderResource($order), 201);
        } catch (Throwable $e) {
            return response('Ошибка при создании заказа', 400);
        }
    }

    public function show(int $id)
    {
        try {
            return new OrderResource(Order::findOrFail($id));
        } catch (Throwable $e) {
            return response('Не удалось найти заказ', 400);
        }
    }
}
