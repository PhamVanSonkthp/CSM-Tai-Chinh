<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, ShouldAutoSize, WithHeadings
{

    private $search_query;
    private $gender;
    private $start;
    private $end;
    private $date_of_birth;

    /**
     * @param $search_query
     * @param $gender
     * @param $start
     * @param $end
     */
    public function __construct($search_query, $gender, $start, $end, $date_of_birth)
    {
        $this->search_query = $search_query;
        $this->gender = $gender;
        $this->start = $start;
        $this->end = $end;
        $this->date_of_birth = $date_of_birth;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = User::where('is_admin', 0);

        if (isset($this->search_query) && !empty($this->search_query)) {
            $query = $query->where(function ($query) {
                $query->orWhere('name', 'LIKE', "%{$this->search_query}%");
                $query->orWhere('phone', 'LIKE', "%{$this->search_query}%");
                $query->orWhere('email', 'LIKE', "%{$this->search_query}%");
                $query->orWhere('user_discord', 'LIKE', "%{$this->search_query}%");
            });
        }

        if (isset($this->gender) && (!empty($this->gender) || strlen($this->gender) > 0))  {
            $query = $query->where('gender', $this->gender);
        }

        if(isset($this->start) && !empty($this->start)){
            $query = $query->whereDate('created_at', '>=' , $this->start);
        }

        if(isset($this->end) && !empty($this->end)){
            $query = $query->whereDate('created_at', '<=' , $this->end);
        }

        if (isset($_GET['date_of_birth']) && !empty($_GET['date_of_birth'])) {
            $query = $query->whereMonth('date_of_birth',now()->month)->whereDay('date_of_birth',now()->day)->where('is_admin' , 0);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        $headings = [
            ['ID', 'Họ và tên', 'Email', 'Xác thực Email lúc', 'Ngày tạo', 'Ngày cập nhật gần nhất', 'Ngày xóa', 'Điểm', 'Trạng thái', 'Số điện thoại', 'User discord', 'Ngày sinh', 'Giới tính']
        ];

        return $headings;
    }

}
