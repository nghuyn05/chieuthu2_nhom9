<?php

namespace App\Models;

// 1. Thêm dòng import này để dùng quyền hạn đăng nhập
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 2. Thay đổi từ "extends Model" thành "extends Authenticatable"
class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customers';
    
    // Lưu ý: Không nên đưa 'id' vào fillable vì nó là tự tăng
    protected $fillable = ['name', 'email', 'password', 'phone'];

    // 3. (Tùy chọn) Ẩn mật khẩu khi xuất dữ liệu ra JSON để bảo mật
    protected $hidden = [
        'password',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}