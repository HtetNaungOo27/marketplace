<?php

namespace App\Orchid\Screens;

use App\Models\VendorPayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class PayoutScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'payouts' => VendorPayout::with(['vendor.user', 'order'])
                ->latest()
                ->get(),
        ];
    }

    public function name(): ?string
    {
        return 'Vendor Payouts';
    }

    public function description(): ?string
    {
        return 'Review and release vendor payouts.';
    }

    public function layout(): iterable
    {
        return [
            Layout::table('payouts', [
                TD::make('id', 'ID'),

                TD::make('vendor.store_name', 'Store'),

                TD::make('vendor.user.name', 'Vendor'),

                TD::make('order_id', 'Order')
                    ->render(fn (VendorPayout $payout) => '#' . $payout->order_id),

                TD::make('gross_amount', 'Gross')
                    ->render(fn (VendorPayout $payout) => '$' . number_format($payout->gross_amount, 2)),

                TD::make('commission_amount', 'Commission')
                    ->render(fn (VendorPayout $payout) =>
                        '$' . number_format($payout->commission_amount, 2) .
                        ' (' . $payout->commission_rate . '%)'
                    ),

                TD::make('net_amount', 'Net')
                    ->render(fn (VendorPayout $payout) => '$' . number_format($payout->net_amount, 2)),

                TD::make('payout_status', 'Status'),

                TD::make('Actions')
                    ->render(function (VendorPayout $payout) {
                        return Button::make('Release')
                            ->method('release', ['id' => $payout->id])
                            ->canSee($payout->payout_status === 'Pending');
                    }),
            ]),
        ];
    }

    public function release(Request $request): void
    {
        VendorPayout::findOrFail($request->get('id'))->update([
            'payout_status' => 'Released',
            'payout_date' => now(),
        ]);
    }
}