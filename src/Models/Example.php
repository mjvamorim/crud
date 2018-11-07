<?php

namespace Amorim\Crud\Models;
use Amorim\Tenant\Models\BaseModelTenant;

class Example extends BaseModelTenant
{
    protected $fillable = [
        'id','name', 'postal_code', 'street','number',
        'district', 'complement', 'city',
        'state','country','email','mobile','phone',
    ];
        
    protected $rules = [
        'name' => 'required|min:5|max:50',
        'email' => 'required|email',
    ];

    protected $showable = [
        ['name'=>'id',           'title'=>'Id',          'datatable'=>'false', 'form'=>'false', 'type'=>'id',   ],
        ['name'=>'name',         'title'=>'Nome',        'datatable'=>'true',  'form'=>'true',  'type'=>'text', ],
        ['name'=>'email',        'title'=>'Email',       'datatable'=>'false',  'form'=>'true',  'type'=>'text', ],
        ['name'=>'mobile',       'title'=>'Celular',     'datatable'=>'false',  'form'=>'true',  'type'=>'text', ], 
        ['name'=>'phone',        'title'=>'Telefone',       'datatable'=>'true',  'form'=>'true',  'type'=>'text', ],
        ['name'=>'postal_code',  'title'=>'Cep',         'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'street',       'title'=>'Street',      'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'number',       'title'=>'Number',      'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'complement',   'title'=>'Complement',  'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'district',     'title'=>'District',    'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'city',         'title'=>'City',        'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'state',        'title'=>'State',       'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'country',      'title'=>'Country',     'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
    ];

    public function getNameAttribute($value) {
        return ucwords($value);
    }
    public function setNameAttribute($value) {
        $this->attributes['name'] = ucwords($value);
    }


}
