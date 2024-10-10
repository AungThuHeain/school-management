import axios from "axios";

export default function classroom(){
        return{
            form:{
                school_id:null,
                id:null,
                name:null,
            },
            modalOpen:false,
            editMode:false,
            errors:{},

            init(){},

            create(){
                this.modalOpen = true;
                this.editMode = false;
                this.clear();
            },

            store()
            {
               axios.post(route('classes.store',this.form))
               .then((response)=>{
                  this.reload();
               })
               .catch((error)=>{
                this.errors =error.response.data.errors;
                console.log(error);
               })
            },

            edit(school)
            {
                this.modalOpen = true;
                this.editMode = true;
                this.form.id = school.id;
                this.form.name = school.name;

            },

            update()
            {
               axios.post(route('classes.update',this.form.id),{...this.form,_method:'PUT'})
               .then((response)=>{
                   this.reload();
               })
               .catch((error)=>{
                this.errors =error.response.data.errors;
                console.log(error);
               })
            },

            reload()
            {
                window.location = window.location.href.split('?')[0];
            },

            clear()
            {
                this.form.id = null;
                this.form.name = null;
            }
        }



}
