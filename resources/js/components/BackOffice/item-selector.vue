<template>
    <div>
        <form id="000-FI">

        </form>
    </div>
</template>

<script>
import axios from 'axios';
import promise from '../../../../public/ckeditor/vendor/promise';
export default {
    methods: {
        prepare(){
            let self = this;
            
            // || Getting data from server
            axios.post(self.RequestUrl).then(function(response){
                self.Response = response.data;
                self.ShowArray = self.Response;

                // || Load all the data
                self.addSelect();
            });
            
        },
        //------//
        getCSRF(){
            this.CSRF = document.head.querySelector('meta[name="csrf-token"]').content;
        },
        search(){

        },

        async addSelect(){
            let Select = document.createElement("select");
            let Form = document.getElementById("000-FI");
            let Fop = document.createElement("option");
            let Div = document.createElement("div");
            let Self = this;

            // || Setting classes
            Select.setAttribute("class", "form-select item-selector-select");
            Form.setAttribute("class", "item-selector-form");
            Div.setAttribute("class", "item-selector-div");
            

            // || Setting default option
            Fop.text = "Seleccione una opcion para " + this.ModelType;

            // || Getting model by id
            let Model = await this.getModelByID(this.ModelId);
            
            if(Model.name != ""){
                Fop.text = Model.name;
            }

            // || Default election is Fop
            this.Election = Fop;
            Select.appendChild(Fop);

            // || Iterating the Server Response
            this.Response.map(function(response){

                // || If it's different to the Fop
                if(response.name != Fop.text){
                    // || Creating a new option
                    let Option = document.createElement("option");
                    Option.text = response.name;

                    // || Appending the new option to the Select
                    Select.appendChild(Option);
                }
            });

            // || Adding the select to the div
            Div.appendChild(Select);

            // || Adding the div to the form
            Form.appendChild(Div);

            // || Adding an event listener for option change
            Select.addEventListener("change", function(event){
                Self.Election = this.selectedOptions[0];

                // || Send change to server
                
                let Dest = (Self.SendUrl == '')? Self.SendUrl : '/admin/'+ Self.Parent + "/guardar-props"
                axios.post(Dest, 
                {
                    [Self.ModelType]: Self.Election.value, 
                    id: Self.parent_id
                }).then(function(response){
                    
                });
            });
        },

        getModelByID(ID){
            let self = this;
            return new promise((resolve) => {
                axios.post('/admin/' + self.ModelType + '/GetById', {id: self.ModelId}).then(function(response){
                    resolve(response.data);
                });
            });
        },

    },
    props: {
        RequestUrl: {
            type: String,
            required: true
        },
        SendUrl: {
            type: String,
            required: false
        },
        ModelType: {
            type: String,
            required: true
        },
        ModelId: {
            type: String,
            required: true
        },
        Parent: {
            type: String,
            required:false
        },
        parent_id: {
            type:String,
            required: true
        },
    },
    components: {
        
    },
    data() {
        return {
            CSRF: '',
            Response: '',
            ShowArray: '',
            InputSearch: '',

            Election: '',
            Form: '',

        }
    },
    mounted() {
        this.getCSRF();
        this.prepare();
    },
}
</script>

<style>
.item-selector-div {
    display: flex;
    align-items: center;

    margin-top: 2%;
}
</style>