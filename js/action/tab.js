const targets = document.querySelectorAll('[data-target]')

targets.forEach(target => {

    target.addEventListener('click', () => {

        const t = document.querySelector(target.dataset.target)
        t.classList.add('active')
    })
})