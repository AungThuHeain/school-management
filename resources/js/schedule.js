export default function schedule()
{
    return{
        form:{
            id:null,
            school_id:null,
            name:null,
            check_in:'00:00',
            check_out:'00:00',
            classes:[],
        },
        modalOpen:false,
        editMode:false,
        Classes:null,
        errors:{},
        init(){
            this.getClasses();
        },
        create(){
            this.modalOpen = true;
            this.clear();
        },
        getClasses($id=null){
            axios.get(route('getCLassrooms',$id))
            .then((response)=>{
                this.Classes = response.data.classes;
                console.log(this.Classes)
            })
            .catch((error)=>{
                this.errors = error.response.data.errors;
            })
        },
        //add and remove when click on class checkbox
        toggleClass(id){
            if(this.form.classes.includes(id)){
                this.form.classes = this.form.classes.filter(item => item !== id);
                return;
            }
            this.form.classes.push(id);
        },
        store()
        {
            axios.post(route('schedules.store'),this.form)
            .then((response)=>{
                this.modalOpen = false;
                this.reload();
            })
            .catch((error)=>{
                this.errors = error.response.data.errors;
            })
        },
        edit(schedule){
            this.getClasses(schedule.id);
            let classrooms = schedule.class_rooms;
            let class_rooms = classrooms.map(item => item.id);

            this.modalOpen = true;
            this.editMode = true;
            this.form.id = schedule.id;
            this.form.name = schedule.name;
            this.form.check_in = schedule.check_in,
            this.form.check_out = schedule.check_out,
            this.form.classes = class_rooms;
        },
        update()
        {
            axios.put(route('schedules.update',this.form.id),this.form)
            .then((response)=>{
                this.modalOpen = false;
                this.reload();
            })
            .catch((error)=>{
                this.errors = error.response.data.errors;
            })
        },
        clear(){
            this.form.id = null;
            this.form.name = null;
            this.form.classes = [];
            this.form.check_in = '09:00';
            this.form.check_out = '16:00';
            this.errors = {};
            this.getClasses();
        },
        reload(){
            window.location = window.location.href.split('?')[0];
        }
    }
}
