jQuery(document).ready(function($) {
    $.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'get_architecture_projects'
        },
        success: function(response) {
            console.log(response.data);

            response.data.forEach(function(project) {
              var proj=`
                <div class="project">
            <b>ID=`+project.id+`</b>
            <h2>`+project.title+`</h2>
            <a href="`+project.link+`" style="">Project Link</a>
        </div>
              `;
            $('.task5 .flexed').append(proj);
            });
        },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });
});
