require('./bootstrap');

(() => {
    const parent = document.querySelector('.for--file')

    if (parent) {
        const button = parent.querySelector('button')
        const input = parent.querySelector('input')
        const span = parent.querySelector('span')

        button.addEventListener('click', () => {
            button.parentElement.querySelector('input').click()
        })

        input.addEventListener('change', () => {
            const value = input.value
            const split = value.includes('/') ? value.split('/') : value.split('\\')
            const name = split[split.length - 1]

            span.innerText = name
        })
    }
})()