// observer
const IO = new IntersectionObserver( callback, { threshold: 1 } )

// First element to target
const el = document.querySelector( '.counter' )

// all numbers
const counters = document.querySelectorAll( '.counter' )
IO.observe( el )
