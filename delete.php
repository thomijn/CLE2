<script>

    function changeOptions(selectEl) {
        let selectedValue = selectEl.options[selectEl.selectedIndex].value;
        let subForms = document.getElementsByClassName('className')
        for (let i = 0; i < subForms.length; i += 1) {
            if (selectedValue === subForms[i].name) {
                subForms[i].setAttribute('style', 'display:block')
            } else {
                subForms[i].setAttribute('style', 'display:none')
            }
        }
    }

</script>