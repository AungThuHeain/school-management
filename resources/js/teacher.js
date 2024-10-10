import axios from "axios";
import school from "./school";

export default function teacher()
{
   return{
     form:{
        school_id:null,
        id:null,
        name:null,
        email:null,
        phone:null,
        password:null,
     },
     modalOpen:false,
     editMode:false,
     errors:{},

     init(){

     },

     create()
     {
      this.modalOpen = true;
      this.clear();
     },

     edit($teacher)
     {
        console.log("teacher",$teacher);
        this.modalOpen = true;
        this.editMode = true;
        this.form.id = $teacher.id;
        this.form.name = $teacher.name;
        this.form.email = $teacher.email;
        this.form.phone = $teacher.phone;
        this.form.password = null;
     },

     update()
     {
       axios.post(route('teachers.update',this.form.id),{...this.form,_method:'PUT'})
       .then((response)=>{
          this.reload();
       })
       .catch((error)=>{
           this.errors = error.response.data.errors;
       })
     },

     store()
     {
        axios.post(route('teachers.store',this.form))
        .then((response)=>{
           this.reload();
        })
        .catch((error)=>{
            this.errors = error.response.data.errors;
            console.log(error)
        })
     },

     reload()
     {
       window.location = window.location.href.split('?')[0];
     },

     clear()
     {
        this.id = null,
        this.name = null,
        this.email = null,
        this.phone = null,
        this.password = null
     },

   }
}
