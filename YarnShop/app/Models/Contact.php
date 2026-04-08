<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    // ✅ THÊM: cho phép insert hàng loạt (bạn đã làm đúng)
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status', 
        'customer_id',
        'admin_id',
        'reply',
        'replied_at',
    ];

    // ✅ THÊM: đảm bảo Laravel tự xử lý created_at, updated_at
    public $timestamps = true;

    // ✅ THÊM (khuyên dùng): ép kiểu dữ liệu
    protected $casts = [
        'status' => 'integer',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}