import axios from "axios";

export default function school(){
    return{
        form:{
            id:null,
            name:null,
            is_active:false,
        },
        modalOpen:false,
        editMode:false,
        errors:{},

        init()
        {

        },

        edit(school)
        {
            this.modalOpen = true;
            this.editMode = true;
            this.form.id = school.id;
            this.form.name = school.name;
            this.form.is_active = school.is_active;
        },

        update()
        {
           axios.post(route('admin.schools.update',this.form.id),{...this.form,_method:'PUT'})
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
            this.form.is_active = false;
        }


    }
}
