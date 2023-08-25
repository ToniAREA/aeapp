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
                'title' => 'to_do_create',
            ],
            [
                'id'    => 55,
                'title' => 'to_do_edit',
            ],
            [
                'id'    => 56,
                'title' => 'to_do_show',
            ],
            [
                'id'    => 57,
                'title' => 'to_do_delete',
            ],
            [
                'id'    => 58,
                'title' => 'to_do_access',
            ],
            [
                'id'    => 59,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 60,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 61,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 62,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 63,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 64,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 65,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 66,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 67,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 68,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 69,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 70,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 71,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 72,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 73,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 74,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 75,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 76,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 77,
                'title' => 'product_create',
            ],
            [
                'id'    => 78,
                'title' => 'product_edit',
            ],
            [
                'id'    => 79,
                'title' => 'product_show',
            ],
            [
                'id'    => 80,
                'title' => 'product_delete',
            ],
            [
                'id'    => 81,
                'title' => 'product_access',
            ],
            [
                'id'    => 82,
                'title' => 'marina_create',
            ],
            [
                'id'    => 83,
                'title' => 'marina_edit',
            ],
            [
                'id'    => 84,
                'title' => 'marina_show',
            ],
            [
                'id'    => 85,
                'title' => 'marina_delete',
            ],
            [
                'id'    => 86,
                'title' => 'marina_access',
            ],
            [
                'id'    => 87,
                'title' => 'contact_management_access',
            ],
            [
                'id'    => 88,
                'title' => 'contact_company_create',
            ],
            [
                'id'    => 89,
                'title' => 'contact_company_edit',
            ],
            [
                'id'    => 90,
                'title' => 'contact_company_show',
            ],
            [
                'id'    => 91,
                'title' => 'contact_company_delete',
            ],
            [
                'id'    => 92,
                'title' => 'contact_company_access',
            ],
            [
                'id'    => 93,
                'title' => 'contact_contact_create',
            ],
            [
                'id'    => 94,
                'title' => 'contact_contact_edit',
            ],
            [
                'id'    => 95,
                'title' => 'contact_contact_show',
            ],
            [
                'id'    => 96,
                'title' => 'contact_contact_delete',
            ],
            [
                'id'    => 97,
                'title' => 'contact_contact_access',
            ],
            [
                'id'    => 98,
                'title' => 'employee_create',
            ],
            [
                'id'    => 99,
                'title' => 'employee_edit',
            ],
            [
                'id'    => 100,
                'title' => 'employee_show',
            ],
            [
                'id'    => 101,
                'title' => 'employee_delete',
            ],
            [
                'id'    => 102,
                'title' => 'employee_access',
            ],
            [
                'id'    => 103,
                'title' => 'provider_create',
            ],
            [
                'id'    => 104,
                'title' => 'provider_edit',
            ],
            [
                'id'    => 105,
                'title' => 'provider_show',
            ],
            [
                'id'    => 106,
                'title' => 'provider_delete',
            ],
            [
                'id'    => 107,
                'title' => 'provider_access',
            ],
            [
                'id'    => 108,
                'title' => 'brand_create',
            ],
            [
                'id'    => 109,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 110,
                'title' => 'brand_show',
            ],
            [
                'id'    => 111,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 112,
                'title' => 'brand_access',
            ],
            [
                'id'    => 113,
                'title' => 'proforma_create',
            ],
            [
                'id'    => 114,
                'title' => 'proforma_edit',
            ],
            [
                'id'    => 115,
                'title' => 'proforma_show',
            ],
            [
                'id'    => 116,
                'title' => 'proforma_delete',
            ],
            [
                'id'    => 117,
                'title' => 'proforma_access',
            ],
            [
                'id'    => 118,
                'title' => 'claim_create',
            ],
            [
                'id'    => 119,
                'title' => 'claim_edit',
            ],
            [
                'id'    => 120,
                'title' => 'claim_show',
            ],
            [
                'id'    => 121,
                'title' => 'claim_delete',
            ],
            [
                'id'    => 122,
                'title' => 'claim_access',
            ],
            [
                'id'    => 123,
                'title' => 'billing_access',
            ],
            [
                'id'    => 124,
                'title' => 'payment_create',
            ],
            [
                'id'    => 125,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 126,
                'title' => 'payment_show',
            ],
            [
                'id'    => 127,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 128,
                'title' => 'payment_access',
            ],
            [
                'id'    => 129,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 130,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 131,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 132,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 133,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 134,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 135,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 136,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 137,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 138,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 139,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 140,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 141,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 142,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 143,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 144,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 145,
                'title' => 'asset_create',
            ],
            [
                'id'    => 146,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 147,
                'title' => 'asset_show',
            ],
            [
                'id'    => 148,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 149,
                'title' => 'asset_access',
            ],
            [
                'id'    => 150,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 151,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 152,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 153,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 154,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 155,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 156,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 157,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 158,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 159,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 160,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 161,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 162,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 163,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 164,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 165,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 166,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 167,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 168,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 169,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 170,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 171,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 172,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 173,
                'title' => 'expense_create',
            ],
            [
                'id'    => 174,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 175,
                'title' => 'expense_show',
            ],
            [
                'id'    => 176,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 177,
                'title' => 'expense_access',
            ],
            [
                'id'    => 178,
                'title' => 'income_create',
            ],
            [
                'id'    => 179,
                'title' => 'income_edit',
            ],
            [
                'id'    => 180,
                'title' => 'income_show',
            ],
            [
                'id'    => 181,
                'title' => 'income_delete',
            ],
            [
                'id'    => 182,
                'title' => 'income_access',
            ],
            [
                'id'    => 183,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 184,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 185,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 186,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 187,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 188,
                'title' => 'mat_log_create',
            ],
            [
                'id'    => 189,
                'title' => 'mat_log_edit',
            ],
            [
                'id'    => 190,
                'title' => 'mat_log_show',
            ],
            [
                'id'    => 191,
                'title' => 'mat_log_delete',
            ],
            [
                'id'    => 192,
                'title' => 'mat_log_access',
            ],
            [
                'id'    => 193,
                'title' => 'setup_access',
            ],
            [
                'id'    => 194,
                'title' => 'contact_tag_create',
            ],
            [
                'id'    => 195,
                'title' => 'contact_tag_edit',
            ],
            [
                'id'    => 196,
                'title' => 'contact_tag_show',
            ],
            [
                'id'    => 197,
                'title' => 'contact_tag_delete',
            ],
            [
                'id'    => 198,
                'title' => 'contact_tag_access',
            ],
            [
                'id'    => 199,
                'title' => 'priority_create',
            ],
            [
                'id'    => 200,
                'title' => 'priority_edit',
            ],
            [
                'id'    => 201,
                'title' => 'priority_show',
            ],
            [
                'id'    => 202,
                'title' => 'priority_delete',
            ],
            [
                'id'    => 203,
                'title' => 'priority_access',
            ],
            [
                'id'    => 204,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
