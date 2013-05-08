<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="template-upload fade">
        {% if (file.error) { %}
          <span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
                       {% if (!o.options.autoUpload) { %}
               
            {% } %}
        {% } else { %}
        {% } %}
        {% if (!i) { %}


        {% } %}
    </div>
{% } %}
</script>
