<?php

namespace App\Policies;

use App\Models\Penjualan;
use App\Models\User;

class PenjualanPolicy
{
    /**
     * Lihat detail transaksi:
     * - Admin boleh lihat SEMUA transaksi, status apapun
     * - Kasir hanya boleh lihat transaksi miliknya sendiri, status apapun
     */
    public function view(User $user, Penjualan $penjualan): bool
    {
        if ($user->role->name === 'admin') {
            return true;
        }

        return $user->id === $penjualan->user_id;
    }

    /**
     * Update transaksi (checkout/edit):
     * - Admin boleh update semua
     * - Kasir hanya boleh update transaksi miliknya, dan hanya saat masih OPEN
     */
    public function update(User $user, Penjualan $penjualan): bool
    {
        if ($user->role->name === 'admin') {
            return true;
        }

        return $user->id === $penjualan->user_id && $penjualan->status === 'OPEN';
    }

    /**
     * Hapus/batalkan transaksi:
     * - Admin boleh hapus transaksi apapun yang masih OPEN
     * - Kasir hanya boleh hapus transaksi miliknya sendiri yang masih OPEN
     */
    public function delete(User $user, Penjualan $penjualan): bool
    {
        if ($penjualan->status !== 'OPEN') {
            return false;
        }

        return $user->role->name === 'admin' || $user->id === $penjualan->user_id;
    }
}