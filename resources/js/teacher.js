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
        role:null,
        class_id:null,
     },
     roles:null,
     classes:null,
     modalOpen:false,
     editMode:false,
     errors:{},

     init(){
      this.getRoleAndClass();
     },

     create()
     {
      this.modalOpen = true;
      this.clear();
     },

     getRoleAndClass()
     {
        axios.get(route('getRolesClasses'))
        .then((response)=>{
            this.roles = response.data.roles.filter((role)=>(role.name != 'Student' && role.name != 'Owner'));
            this.classes = response.data.classes;
            })
        .catch((error)=>{
                console.log(error.response.data.errors);
                this.errors = error.response.data.errors;
             })
    },


     edit($teacher)
     {
        this.clear();
        this.modalOpen = true;
        this.editMode = true;
        this.form.class_id = $teacher.class_id;
        this.form.role = $teacher.roles[0].name;
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
        this.form.id = null,
        this.form.name = null,
        this.form.email = null,
        this.form.phone = null,
        this.form.password = null,
        this.form.role = null,
        this.form.class_id = null,
        this.errors=null
     },

   }
}
