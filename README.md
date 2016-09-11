# timer
a simple timer class for php code performance testing

## Example

```
use TripleI\Timer\Timer;

// start the timer
Timer::start();

/* some expensive code here */
// let's see how long it took to execute
Timer::tick('did some fancy stuff');

/* more expensive code here */
// let's see how long it was since the timer initially started
Timer::tick('did more fancy stuff');

// more code to time here. This time we will output a relative timestamp since the last ::tick() as well
Timer::tick('relative timer', true);

// output the end timing
Timer::done();
```

sample output

```
0.27108597755432 - did some fancy stuff
0.47066617012024 - did more fancy stuff
0.84685397148132 - (0.37618780136108) relative timer
0.84687614440918 - Done 
```
