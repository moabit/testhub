<template>
    <div class="container mt-4">
        <div class="editor">
            <form class="form p-4 m-3" action="" method="POST" v-on:submit.prevent="submit" id="form1">
                <TestInfo/>
                <QuestionGuide/>
                <NewQuestions/>
                <SubmitTestForm v-if="questionsCount>4"></SubmitTestForm>
            </form>
        </div>
    </div>
</template>

<script>
import TestInfo from './components/editor/TestInfo'
import NewQuestions from "./components/editor/NewQuestions";
import QuestionGuide from "./components/editor/QuestionGuide";
import SubmitTestForm from "./components/editor/SubmitTestForm";
import {mapGetters} from "vuex";
import axios from "axios";

export default {
    name: 'editor',
    components: {
        QuestionGuide,
        'TestInfo': TestInfo,
        'NewQuestions': NewQuestions,
        SubmitTestForm
    },
    computed: {
        ...mapGetters(['questionsCount']),
    },
    methods: {
        submit() {
            axios.post("/new",this.$store.state).then((response)=>console.log(response),(error) =>console.log(error));
        }
    }
}
</script>
