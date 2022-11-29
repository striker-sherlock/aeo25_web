import counterUp from 'counterup2'

const callback = entries => {
    entries.forEach(entry => {
        const el = entry.target
        if (entry.isIntersecting && !el.classList.contains('is-visible')) {
            for (const counter of counters) {
                counterUp(counter, {
                    duration: 1000,
                    delay: 16,
                })
                el.classList.add('is-visible')
            }
        }
    })
}

// observer
const IO = new IntersectionObserver( callback, { threshold: 1 } )

// First element to target
const el = document.querySelector( '.counter' )

// all numbers
const counters = document.querySelectorAll( '.counter' )
IO.observe( el )