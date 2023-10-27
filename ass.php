<?php
// class Triangle {
//     public $angle1;
//     public $angle2;
//     public $angle3;

//     public function __construct($angle1, $angle2, $angle3) {
//         $this->angle1 = $angle1;
//         $this->angle2 = $angle2;
//         $this->angle3 = $angle3;
//     }

//     public function checkTriangleType() {
//         if ($this->angle1 == 60 && $this->angle2 == 60 && $this->angle3 == 60) {
//             return "Equilateral Triangle";
//         } elseif ($this->angle1 == $this->angle2 || $this->angle2 == $this->angle3 || $this->angle3 == $this->angle1) {
//             return "Isosceles Triangle";
//         } else {
//             return "Scalene Triangle";
//         }
//     }
// }

// // Example usage:
// $angle1 = 60; // First angle in degrees
// $angle2 = 80; // Second angle in degrees
// $angle3 = 80; // Third angle in degrees

// $triangle = new Triangle($angle1, $angle2, $angle3);
// $triangleType = $triangle->checkTriangleType();
// echo "Triangle with angles $angle1, $angle2, and $angle3 is a $triangleType.";

class Triangle {
    public $base;
    public $height;

    public function setBase($base) {
        $this->base = $base;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function calculateArea() {
        return (0.5 * $this->base * $this->height);
    }
}

$triangle = new Triangle();
$triangle->setBase(10);    // Set the base of the triangle
$triangle->setHeight(5);   // Set the height of the triangle
$area = $triangle->calculateArea();
echo "The area of the triangle is: $area square units";
 ?>
