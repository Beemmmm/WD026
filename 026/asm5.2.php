<?php
    class Rec{
        public $width;
        public $height;

    public function __construct ($width,$height){
        $this->width = $width;
        $this->height = $height;
        
    }
    public function calculateArea() {
        return $this->width * $this->height;
    }
     public function calculatePerimeter() {
        return 2 * ($this->width + $this->height);
    }
     public function isSquare() {
        return $this->width === $this->height;
    }
    public function show() {
        echo "--- ข้อมูลสี่เหลี่ยม ---<br>";
        echo "ความกว้าง: " . $this->width . "<br>";
        echo "ความยาว: " . $this->height . "<br>";
        echo "พื้นที่: " . $this->calculateArea() . "<br>";
        echo "เส้นรอบรูป: " . $this->calculatePerimeter() . "<br>";
        
        if ($this->isSquare()) {
            echo "เป็นสี่เหลี่ยมจัตุรัส: ใช่<br>";
        } else {
            echo "เป็นสี่เหลี่ยมจัตุรัส: ไม่ใช่<br>";
        }
        echo "--------------------------<br><br>";
    }
  
}
    $rect1 = new Rec(10, 5);
    $rect1->show();
    $rect2 = new Rec(7, 7);
    $rect2->show();

?>