<script>
    function destroy(id) {
        if (confirm('确定要删除此条目(id=' + id + ')')) {
            document.querySelector('form.form-destroy[data-id="' + id + '"]').submit();
        }
    }
</script>