import 'emoji-picker-element';

export default (Alpine) => {
    Alpine.data(
        'emojiPickerFormComponent',
        ({ isAutofocused, isDisabled, state }) => {
            return {
                state,

                init: function () {
                    if (!(this.state === null || this.state === '')) {
                        this.setState(this.state)
                    }

                    if (isAutofocused) {
                        this.togglePanelVisibility(this.$refs.input)
                    }

                    this.$refs.input.addEventListener('change', (event) => {
                        this.setState(event.target.value)
                    })

                    this.$refs.panel.addEventListener(
                        'emoji-click',
                        (event) => {
                            this.setState(event.detail.unicode)
                        },
                    )
                },

                togglePanelVisibility: function () {
                    if (isDisabled) {
                        return
                    }

                    this.$refs.panel.toggle(this.$refs.input)
                },

                setState: function (value) {
                    this.state = value

                    this.$refs.input.value = value
                    this.$refs.panel.color = value
                },

                isOpen: function () {
                    return this.$refs.panel.style.display === 'block'
                },
            }
        },
    )
}
