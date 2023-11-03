
<!-- @vite('resources/js/forms_builder.js') -->
<script src="{{ asset('js/forms_builder.js') }}"></script> 
<x-layouts.app>
    <div class=" rounded mt-3 p-3 mp-3">
        <script> 
            //let send_to = "{{ url('student/submit_worksheet') }}";
            let csrf = '@csrf';
        </script>
        <div class="">
            <div style='margin:10px;'></div>
            <div class="forms_builder" id='editor'></div>
            <div style='margin:10px;'></div>
            <div class="worksheet" id='viewer'></div>
            <div style='margin:10px;'></div>
        </div>
        <?php 
            if(isset($worksheet)){
                echo(
                    "<script> let data_json = ".json_encode($worksheet->data_json)."; </script>"
                );
            }else{
                echo( "<script> let data_json = null; </script>" );
            }
        ?>
        <script>
            let form = new forms_builder( "{{ url('manage/form_templates/') }}", csrf);
            //form.draw_editor(editor, data_json);
            form.draw_editor(editor, JSON.stringify(form.get_test_form()));
        </script>
    </div>

</x-layouts.app>