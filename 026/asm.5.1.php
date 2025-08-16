<?php
    class Person{
        public $name;
        public $ages;
        public $jobs;
        public $gender;

    public function __construct ($n,$a,$j,$g){
        $this->name = $n;
        $this->ages = $a;
        $this->jobs = $j;
         $this->gender = $g;
    }
    public function introduce() {
        $frist = '';
        $tell = '';
        if ($this->gender === 'male') {
            $frist = 'สวัสดีครับ';
        } elseif ($this->gender === 'female') {
            $frist = 'สวัสดีค่ะ';
        } else {
            $frist = 'สวัสดีครับ/ค่ะ'; 
        }
        if ($this->ages < 18) {
            if ($this->gender === 'male') {
                $tell = 'ผม';
            } elseif ($this->gender === 'female') {
                $tell = 'ฉัน';
            } else {
                $tell = 'ผม/ฉัน';
            }
        } else {
            if ($this->gender === 'male') {
                $tell = 'ผม';
            } elseif ($this->gender === 'female') {
                $tell = 'ฉัน';
            } else {
                $tell = 'ผม/ฉัน';
            }
        }
        echo "$frist $tell ชื่อ $this->name อายุ $this->ages ปี ทำงานเป็น $this->jobs <br>";
    }
}
    $ps1 = new Person("ณภัทร", 17, "IT Support", "male");
    $ps2 = new Person("ยลดา", 21, "Dev", "female");
    $ps1->introduce();
    $ps2->introduce();
?>