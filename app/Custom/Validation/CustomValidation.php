<?php
use App\Model\KPI;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

// https://laracasts.com/discuss/channels/general-discussion/l5-where-to-add-custom-validation-function
// http://laravel.com/docs/4.2/validation#custom-validation-rules
class CustomValidator extends Illuminate\Validation\Validator {

    public function validateFoo($attribute, $value, $parameters)
    {
        return $value == 'foo';
    }

    public function validateKPIParent($attribute, $value, $parameters)
    {
        return $value == 'foo';
    }



}

?>