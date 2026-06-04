<?php

namespace Tests\Unit;

use App\Rules\CpfOuCnpj;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CpfOuCnpjTest extends TestCase
{
    protected function passes(mixed $value): bool
    {
        $validator = Validator::make(
            ['document' => $value],
            ['document' => [new CpfOuCnpj]],
        );

        return ! $validator->fails();
    }

    public function test_valid_cpf_passes(): void
    {
        $this->assertTrue($this->passes('52998224725'));
    }

    public function test_valid_formatted_cpf_passes(): void
    {
        $this->assertTrue($this->passes('529.982.247-25'));
    }

    public function test_cpf_with_wrong_check_digit_fails(): void
    {
        $this->assertFalse($this->passes('52998224726'));
    }

    public function test_repeated_digits_cpf_fails(): void
    {
        $this->assertFalse($this->passes('111.111.111-11'));
    }

    public function test_valid_cnpj_passes(): void
    {
        $this->assertTrue($this->passes('11.222.333/0001-81'));
    }

    public function test_cnpj_with_wrong_check_digit_fails(): void
    {
        $this->assertFalse($this->passes('11222333000182'));
    }

    public function test_wrong_length_fails(): void
    {
        $this->assertFalse($this->passes('1234567890'));
        $this->assertFalse($this->passes('abc'));
    }

    public function test_empty_value_is_rejected_when_combined_with_required(): void
    {
        $validator = Validator::make(
            ['document' => ''],
            ['document' => ['required', new CpfOuCnpj]],
        );

        $this->assertTrue($validator->fails());
    }
}
