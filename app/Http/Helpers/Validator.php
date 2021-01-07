<?php

namespace App\Http\Helpers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as IlluminateValidator;

abstract class Validator {

    public function validate(Request $data, string $rules, array $custom_errors = array()) {
        $validation = $data->validate($this->rules[$rules], $custom_errors);
    }
}
