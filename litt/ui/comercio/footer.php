<script type="text/javascript">
    
    $("#formulario").on('submit',function(){
        window.retornar = true;
        $(":text, :file, :checkbox, select, textarea").each(function() {
            if($(this).val() == ""){
                alert("Hay campos vacios, por favor, verifiquelos");
                window.retornar = false;
                return false;
            }
        });
        return window.retornar;
    });
</script>

</body>
</html>
