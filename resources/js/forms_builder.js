function forms_builder(send_template_to, csrf){
    this.send_template_to = send_template_to;
    this.csrf = csrf;
    this.id_counter = 0;
    this.template_id = -1;
    this.get_id = (prefix)=>{ return prefix + ++this.id_counter;};
    this.palette = {
        form:{
            editor:()=>{
                let form = document.createElement('form');
                form.setAttribute('debug', 'form');
                form.action = this.send_template_to;
                //console.warn(this.csrf);
                form.method = "POST";
                form.classList = "";
                form.innerHTML += csrf;
                return form;
            },
            viewer:()=>{return 'viewer version element';},
        },
        header:{
            editor:(data)=>{
                let node = document.createElement('div');
                node.setAttribute('debug', 'header');
                node.id = data.id;
                node.innerHTML =
                '<h2 class="form_header">Редактор форм</h2>'
                +'<div class="header_block">'
                +'<input class="form-control" worksheet_field type="hidden" name="type" value = "header">'
                +'<label class="w-full helios-bold my-2 bg-teal-600" for="' + data.id + '_title">Заголовок формы</label>'
                +'<input class="form-control" worksheet_field type="text" name="title" id="' + data.id + '_title" value="'+data.title+'">'
                +'<label class="helios-bold my-2" for="' + data.id + '_description">Описание формы</label>'
                +'<textarea class="form-control" worksheet_field name="description" id="' + data.id + '_description"  rows="3" class="w-100">'+data.description+'</textarea>'
                +'</div>'
                ;
                return node;
            },
            viewer:()=>{return 'viewer version element';},
        },
        control:{
            editor:(form)=>{
                let node = document.createElement('div');
                node.classList = 'd-flex';
                node.setAttribute('debug', 'control');
                let btn_add = document.createElement('button');
                btn_add.innerHTML = 'добавить поле';
                btn_add.classList = 'button button_add mr-5';
                btn_add.onclick = (e)=>{e.preventDefault(); this.add_field(e,form)};

                let btn_preview = document.createElement('button');
                btn_preview.innerHTML = 'предпросмотр';
                let btn_get_json = document.createElement('button');
                btn_get_json.classList = 'button button_gray mr-5';
                btn_get_json.innerHTML = 'получить json';
                btn_get_json.onclick = (e)=>{e.preventDefault(); this.get_json(form);};

                let btn_submit = document.createElement('button');
                btn_submit.classList = 'button button_ok mr-5';
                btn_submit.innerHTML = 'сохранить форму';
                btn_submit.onclick = (e)=>{e.preventDefault(); this.send_template(form)}; 
                
                node.append(btn_add);
                node.append(btn_preview);
                node.append(btn_get_json);
                node.append(btn_submit);
                // node.innerHTML_ = 
                // '<div class="d-flex"><div><button onclick="'+function(e){this.add_field(e);}+'">добавить поле</button></div><div><button onclick="window.builder.get_json();">предпросмотр</button></div><div><button type="submit" onclick="window.builder.save_template()">сохранить форму</button></div></div>';
                return node;
            },
            viewer:()=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
        },
        select:{
            editor:(data)=>{
                let node = document.createElement('div');
                node.setAttribute('debug', 'select');
                node.classList.add('type_field_select');
                if(data.type === 'header'){return null;}
                if(data.type === 'form_title'){return null;}
                if(!this.palette[data.type]){ 
                    console.warn('тип поля - ' + data.type + ' не поддерживается');
                    /* return null;*/
                }
                let select = document.createElement('select');
                select.setAttribute('worksheet_field', '');
                select.name = 'type';
                select.classList = 'form-control my-2';
                select.onchange = (e)=>{e.preventDefault(); this.change_type(e)};
                select.innerHTML = 
                "<option value='null'>тип поля</option>"
                +"<option value='checkbox'>флаг: да/нет</option>"
                +"<option value='checkbox_group'>группа флагов: да/нет </option>"
                +"<option value='radio_group'>выбор из вариантов </option>"
                // +"<option value='string'>строка</option>"
                // +"<option value='textarea'>текст</option>"
                // +"<option value='date'>дата</option>"
                // +"<option value='files'>файлы</option>"
                // +"<option value='number'>число</option>"
                ;
                if(this.palette[data.type]){
                    select.value = data.type;
                }
                node.append(select);
                let button = document.createElement('button');
                button.onclick = (e)=>{e.preventDefault(); this.remove_field(e)};
                button.classList.add('delete_button');
                button.innerHTML = 'удалить';
                node.append(button);
                return node;
            },
            viewer:()=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
        },
        new:{
            editor:(data)=>{
                let node = document.createElement('div');
                return node;
            },
            viewer:()=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
        },
        base:{
            editor:(data)=>{
                let node = document.createElement('div');
                node.id = data.id;
                node.innerHTML = 
                '<div class="field_header">'
                +'<input worksheet_field type="hidden" name="field_type" value = "' + data.type + '">'
                +'<label class="helios my-2" for="header_' + data.id + '">Заголовок</label>'
                +'<input worksheet_field type="hidden" name="input_name" value="'+ data.input_name +'">'
                +'<input class="form-control" worksheet_field type="text" name="title" id="header_' + data.id + '" value="' + data.title+ '">'
                +'<label class="helios" my-2" for="dsc_' + data.id + '">Описание</label>'
                +'<textarea class="form-control" worksheet_field name="description" id="dsc_' + data.id + '" value="' + data.description +'" cols="30" rows="3">'+data.description+'</textarea>'
                +'</div>'
                ;
                return node;
            },
            viewer:()=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
        },
        textarea:{
            editor:(data)=>{
                let node = this.palette.base.editor(data);
                node.innerHTML += '';
                return node;
            },
            viewer:()=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
        },
        string:{
            editor:(data)=>{
                let node = this.palette.base.editor(data);
                node.innerHTML += '';
                return node;
            },
            viewer:()=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
        },
        date:{
            editor:(data)=>{
                let node = this.palette.base.editor(data);
                node.innerHTML += '';
                return node;
            },
            viewer:()=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
        },
        files:{
            editor:(data)=>{
                let node = this.palette.base.editor(data);
                node.innerHTML += '';
                return node;
            },
            viewer:()=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
        },
        checkbox:{
            editor:(data)=>{
                let node = this.palette.base.editor(data);
                node.innerHTML += '';
                return node;
            },
            viewer:()=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
        },
        checkbox_group:{
            editor:(data)=>{
                let node = this.palette.base.editor(data);
                console.warn(node);
                let options_panel = document.createElement('div');
                options_panel.classList.add('options_panel');
                let add_button = document.createElement('div');
                add_button.classList.add('add_option_button');
                let builder = this;
                add_button.onclick = (e)=>{e.preventDefault(); this.add_option(e, this); };
                add_button.innerHTML = 
                "<button>+ Добавить вариант</button>"
                +""
                +""
                +""
                +""
                ;
                node.append(options_panel);
                options_panel.append(add_button);
                return node;
            },
            viewer:()=>{

            },
        },
        radio_group:{
            editor:(data)=>{
                let node = this.palette.base.editor(data);
                console.warn(node);
                let options_panel = document.createElement('div');
                options_panel.classList = 'options_panel';
                let add_button = document.createElement('div');
                add_button.classList = 'add_option_button';
                let builder = this;
                add_button.onclick = (e)=>{e.preventDefault(); this.add_option(e, this); };
                add_button.innerHTML = 
                "<button>+ Добавить вариант</button>"
                +""
                +""
                +""
                +""
                ;
                node.append(options_panel);
                options_panel.append(add_button);
                return node;
            },
            viewer:()=>{

            }
        },
        number:{
            editor:(data)=>{
                let node = this.palette.base.editor(data);
                node.innerHTML += '';
                return node;
            },
            viewer:()=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
        },
        tmp:{
            editor:(data)=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
            viewer:(data)=>{
                let node = document.createElement('div');
                node.innerHTML = '';
                return node;
            },
        },
        not_supported:{
            editor:(data)=>{
                node = document.createElement('div');
                node.setAttribute('debag', 'not_supported');
                node.innerHTML = '<div><span>Ошибка : тип поля - ( '+data.type+ '), не поддерживается этой версией редактора</span></div>';
                let button = document.createElement('button');
                button.onclick = (e)=>{e.preventDefault(); this.remove_field(e)};
                button.classList = '';
                button.innerHTML = 'удалить';
                node.append(button);
                return node;
            },
            viewer:()=>{return 'viewer version element';},
        },

    };
    this.add_option = (e, name = 'oppa')=>{
        let option_id = this.get_id('option_');
        let options_panel = e.target.parentNode.parentNode;
        let option_container = document.createElement('div');
        option_container.id = 'container_' + option_id;
        option_container.classList.add('option_container');
        option_container.innerHTML =
        "<div>" 
        +"<label for='"+option_id+"'>текст поля</label>"
        +"<input type='text' name='"+option_id+"' id="+option_id+" option>"
        +"</div>" 
        +""
        +""
        ;

        let delete_option_button = document.createElement('div');

        delete_option_button.innerHTML = "<button class='delete_button'>удалить</button>";
        delete_option_button.onclick = (e)=>{ document.getElementById('container_' + option_id).remove();};
        option_container.append(delete_option_button);
        options_panel.append(option_container);

        console.log(e.target.parentNode.parentNode);

    };
    this.remove_field = (e)=>{
        e.target.parentNode.parentNode.remove();
    };

    this.get_empty_item = (type = null)=>{
        return {
                    id:this.get_id("field_"),
                    type: type?type:'',
                    title: '',
                    description: '',
                    input_name: this.get_id("input_"),
                };
    };
    this.get_empty_form = ()=>{
        return {
            aux: {
                id_counter:0,
                template_id: -1,
            },
            items: [
                {
                    type: 'header',
                    title: 'Введите название формы',
                    description: 'Введите описание формы',
                    input_name:'header',
                },
            ]
        }
    };
    this.get_test_form = ()=>{
        return {
            aux: {
                id_counter:25,
            },
            items: [
                {
                    type: 'header',
                    title: 'Введите название формы',
                    description: 'Введите описание формы',
                    input_name:'header',
                },
                {
                    type: 'checkbox_group',
                    title: 'Введите название поля : checkbox_group',
                    description: 'Введите описание поля : checkbox_group',
                    input_name: 'checkbox_group_input_2',
                },

            ],
        };
    };
    this.get_test_form_2 = ()=>{
        return {
            aux: {
                id_counter:25,
            },
            items: [
                {
                    type: 'header',
                    title: 'Введите название формы',
                    description: 'Введите описание формы',
                    input_name:'header',
                },
                {
                    type: 'checkbox_group',
                    title: 'Введите название поля : checkbox_group',
                    description: 'Введите описание поля : checkbox_group',
                    input_name:'input_name : checkbox_group',
                },
                {
                    type: 'string',
                    title: 'Введите название поля : string',
                    description: 'Введите описание поля : string',
                    input_name:'input_name : string',
                },
                {
                    type: 'textarea',
                    title: 'Введите название поля : text',
                    description: 'Введите описание поля : text',
                    input_name:'input_name : text',
                },
                {
                    type: 'checkbox',
                    title: 'Введите название поля : checkbox',
                    description: 'Введите описание поля : checkbox',
                    input_name:'input_name : checkbox',
                },
                {
                    type: 'date',
                    title: 'Введите название поля : date',
                    description: 'Введите описание поля : date',
                    input_name:'input_name : date',
                },
                {
                    type: 'files',
                    title: 'Введите название поля : files',
                    description: 'Введите описание поля : files',
                    input_name:'input_name : files',
                },
                {
                    type: 'number',
                    title: 'Введите название поля : number',
                    description: 'Введите описание поля : number',
                    input_name:'input_name : number',
                },
            ],
        };
    };
    this.draw_editor = (parent, json_str = null)=>{
        let form = this.palette.form.editor();
        parent.append(form);
        let data = null;
        if(json_str){
            data = JSON.parse(json_str);
        }else{
            data = this.get_empty_form();
        }
        this.id_counter = data.aux.id_counter;
        this.template_id = data.aux.template_id ?? -1;

        data.items.forEach((item, index, arr)=>{
            this.add_field(null, form, item)
        });

        let control = this.palette.control.editor(form);
        form.after(control);
    };
    this.change_type = (e)=>{
        let base = e.target.parentNode.parentNode;
        base.lastChild.remove();
        let item = this.get_empty_item(e.target.value);
        let inputs = this.create_inputs(item);
        base.append(inputs);
    };
    this.create_inputs = (item)=>{
        let inputs = null;
        if(this.palette[item.type]){
            return this.palette[item.type].editor(item);
        }else if(item.type !== ''){
            return this.palette.not_supported.editor(item);
        }
        return document.createElement('div');
    }
    this.add_field = (event, form, item = null)=>{
        if(item){ 
        }else{
            item = this.get_empty_item();
        }
        let board = document.createElement('div');

        board.classList.add('field_backplane');
        board.setAttribute('debug', 'field_panel');
        let select = this.palette.select.editor(item);
        let inputs = this.create_inputs(item);
        if(select){
                board.append(select);
        };
        board.append(inputs);
        form.append(board);
    };
    this.get_json = (form)=>{
        let result = new Object();
        result.aux = {
            id_counter : this.id_counter,
            template_id : this.template_id,
        };
        result.items = new Array();
        form.childNodes.forEach((item, index, arr)=>{
            if(item.name === "_token" || item.getAttribute('worksheet_hidden')){
                return;
            }
            let options = item.querySelectorAll('[option]');
            let inputs = item.querySelectorAll('[worksheet_field]');
            let obj = new Object();
            inputs.forEach((input, index, arr)=>{
                obj[input.name] = input.value;
                // console.log('input = ', input, input.name, input.value);

            });
            if(options.length > 0){
                obj.options =  new Object();
                options.forEach((option, index, arr)=>{
                    obj.options[option.name] = option.value;
                    // console.log('option = ', option, option.name, option.value,  obj['options']);
                });
            }
            // console.warn('object = ', obj, JSON.stringify(obj));
            result.items.push(obj);
        });
        // console.log(result);
         console.warn(JSON.stringify(result));
        return JSON.stringify(result);
    };
    this.send_template = (form)=>{
        let result_json = this.get_json(form);
        let json = document.createElement('input');
        json.setAttribute('worksheet_hidden', 'worksheet_hidden');
        json.setAttribute('hidden', 'hidden');
        json.name = 'result_json';
        json.value = result_json;
        form.append(json);
        form.submit();

        return;


        // let new_form = new FormData();
        // new_form.append('_token', this.csrf);
        // new_form.append('result_json', result_json);
        // let xhr = XMLHttpRequest();

    };
};