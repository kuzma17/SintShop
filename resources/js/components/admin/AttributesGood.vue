<template>
    <div>
    <table v-if="params.length > 0" class="table">
        <tbody>
       <tr v-for="(param, key) in params">
           <td class="params">
              {{param.id}}
               {{param.name_ru}}
               <span class="badge bg-secondary">{{param.type.title}}</span>
           </td>
           <td>
               <input-set
                   v-if="param.type.id === 1"
                   v-model="val[param.id]"
                   :attribute_id="param.id"
                   :attribute-values="param.values"
               ></input-set>

               <input-string
                   v-if="param.type.id === 2"
                   v-model="val[param.id]"
                   :attribute_id="param.id"
                   :num="key"
               ></input-string>

               <input-float
                   v-if="param.type.id === 3"
                   v-model="val[param.id]"
                   :attribute_id="param.id"
                   :format="param.format"
                   :num="key"
               ></input-float>

               <input-boolean
                   v-if="param.type.id === 4"
                   v-model="val[param.id]"
                   :attribute_id="param.id"
                   :attribute-values="param.values"
               ></input-boolean>

           </td>
       </tr>
        </tbody>
    </table>

    </div>
</template>

<script>

export default {
    name: "AttributesGood",
    props: [
        'attributes',
        'valuesAttribute',
    ],
    mounted() {
        if (this.attributes){
            this.params = this.attributes
        }
      //  console.log(this.param);
        if (this.valuesAttribute) {
            this.val = this.valuesAttribute
        }
       // console.log(this.val);
    },
    // created() {
    //     this.emitter.on('selectCategory', (data) => {
    //         this.getAttributes(data)
    //         if (this.valuesAttribute) {
    //             this.val = this.valuesAttribute
    //         }
    //     })
    // },
    data(){
        return{
            params: [],
            val: [],

        }
    },
    methods:{
        // getAttributes(id){
        //     axios.get('/admin/goods/category/'+id+'/attributes')
        //         .then(response => {
        //             //console.log(response.data);
        //             this.params = response.data
        //
        //         })
        //         .catch(error => {
        //             console.log(error);
        //         })
        // },

        }
}
</script>

<style>
.params{
    min-width: 200px;
}


</style>
