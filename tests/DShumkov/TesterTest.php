<?php
use DShumkov\ProfaneFilter\Tester as Tester;
class TesterTest extends \PHPUnit_Framework_TestCase {

        public $tester;

        public function setUp() {
                $this->tester = new Tester;
        }

        public function testProfane() {
                $this->assertTrue($this->tester->profane('fuck you john doe'));
                $this->assertTrue($this->tester->profane('FUCK you john doe'));
                $this->assertTrue($this->tester->profane('Please Ass youself'));
                $this->assertTrue($this->tester->profane('son-of-a-bitch'));
                $this->assertFalse($this->tester->profane('Meat'));
                $this->assertFalse($this->tester->profane('Apple!'));
                $this->assertFalse($this->tester->profane('Apple'));
                $this->assertFalse($this->tester->profane('This Apple @#$@#$ Is a Big One!'));
        }

        public function testCustomSet() {
            $set = [
                'word' => [
                    'apple',
                    'banana',
                    'strawberry',
                    'f_u_c_k'
                ]
            ];
            $tester = new Tester($set);
            $this->assertTrue($tester->profane('Try your apple'));
            $this->assertTrue($tester->profane('BANANA!!!!!'));
            $this->assertTrue($tester->profane('!f_u_C_k!'));

            $this->assertFalse($tester->profane('!@#!@#!@#'));
            $this->assertFalse($tester->profane('_ _ _'));
            $this->assertFalse($tester->profane('Cool Daddy'));
        }


}