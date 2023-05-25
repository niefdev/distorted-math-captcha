# distorted-math-captcha

**Generates Distorted Word-Based Math Captcha**

how to generate:

```
<?php

include "captcha.php";

$captcha = generate_captcha ();
```

generated captcha:

```
array(2) { ["ask"]=> string(25) "tewnty six miuns tihreetn" ["answer"]=> int(13) }
```

how it work? 

- This script will generate random numbers between 10-100.
- generate another random number but between 1 and the number generated the first time. 
- generate a number by subtracting the first number from the second number.
- determine a random addition or subtraction operation.
- if the operation is subtraction, it will use the third number as the answer and then use the second and third numbers as questions.
- if the operation is addition, it will use the first number as the answer and then use the second and third numbers as problems.
- turn the numbers in the problem into sentences and concatenate them into strings.
- distort the string to make it harder to understand.
