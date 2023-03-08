<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'client_create',
            ],
            [
                'id'    => 18,
                'title' => 'client_edit',
            ],
            [
                'id'    => 19,
                'title' => 'client_show',
            ],
            [
                'id'    => 20,
                'title' => 'client_delete',
            ],
            [
                'id'    => 21,
                'title' => 'client_access',
            ],
            [
                'id'    => 22,
                'title' => 'boat_create',
            ],
            [
                'id'    => 23,
                'title' => 'boat_edit',
            ],
            [
                'id'    => 24,
                'title' => 'boat_show',
            ],
            [
                'id'    => 25,
                'title' => 'boat_delete',
            ],
            [
                'id'    => 26,
                'title' => 'boat_access',
            ],
            [
                'id'    => 27,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 28,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 29,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 30,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 31,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 32,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 33,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 34,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 35,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 36,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 37,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 38,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 39,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 40,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 41,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 42,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 43,
                'title' => 'work_access',
            ],
            [
                'id'    => 44,
                'title' => 'wlog_create',
            ],
            [
                'id'    => 45,
                'title' => 'wlog_edit',
            ],
            [
                'id'    => 46,
                'title' => 'wlog_show',
            ],
            [
                'id'    => 47,
                'title' => 'wlog_delete',
            ],
            [
                'id'    => 48,
                'title' => 'wlog_access',
            ],
            [
                'id'    => 49,
                'title' => 'wlist_create',
            ],
            [
                'id'    => 50,
                'title' => 'wlist_edit',
            ],
            [
                'id'    => 51,
                'title' => 'wlist_show',
            ],
            [
                'id'    => 52,
                'title' => 'wlist_delete',
            ],
            [
                'id'    => 53,
                'title' => 'wlist_access',
            ],
            [
                'id'    => 54,
                'title' => 'material_access',
            ],
            [
                'id'    => 55,
                'title' => 'm_log_create',
            ],
            [
                'id'    => 56,
                'title' => 'm_log_edit',
            ],
            [
                'id'    => 57,
                'title' => 'm_log_show',
            ],
            [
                'id'    => 58,
                'title' => 'm_log_delete',
            ],
            [
                'id'    => 59,
                'title' => 'm_log_access',
            ],
            [
                'id'    => 60,
                'title' => 'to_do_create',
            ],
            [
                'id'    => 61,
                'title' => 'to_do_edit',
            ],
            [
                'id'    => 62,
                'title' => 'to_do_show',
            ],
            [
                'id'    => 63,
                'title' => 'to_do_delete',
            ],
            [
                'id'    => 64,
                'title' => 'to_do_access',
            ],
            [
                'id'    => 65,
                'title' => 'configuration_access',
            ],
            [
                'id'    => 66,
                'title' => 'priority_create',
            ],
            [
                'id'    => 67,
                'title' => 'priority_edit',
            ],
            [
                'id'    => 68,
                'title' => 'priority_show',
            ],
            [
                'id'    => 69,
                'title' => 'priority_delete',
            ],
            [
                'id'    => 70,
                'title' => 'priority_access',
            ],
            [
                'id'    => 71,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 72,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 73,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 74,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 75,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 76,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 77,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 78,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 79,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 80,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 81,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 82,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 83,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 84,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 85,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 86,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 87,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 88,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 89,
                'title' => 'product_create',
            ],
            [
                'id'    => 90,
                'title' => 'product_edit',
            ],
            [
                'id'    => 91,
                'title' => 'product_show',
            ],
            [
                'id'    => 92,
                'title' => 'product_delete',
            ],
            [
                'id'    => 93,
                'title' => 'product_access',
            ],
            [
                'id'    => 94,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 95,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 96,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 97,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 98,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 99,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 100,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 101,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 102,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 103,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 104,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 105,
                'title' => 'task_create',
            ],
            [
                'id'    => 106,
                'title' => 'task_edit',
            ],
            [
                'id'    => 107,
                'title' => 'task_show',
            ],
            [
                'id'    => 108,
                'title' => 'task_delete',
            ],
            [
                'id'    => 109,
                'title' => 'task_access',
            ],
            [
                'id'    => 110,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 111,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
