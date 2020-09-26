<template>
    <div class="container mt-4">
        <div class="editor">
            <form class="form p-4 m-3" action="" method="POST">
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


export default {
    name: 'editor',
    components:{
        QuestionGuide,
        'TestInfo':TestInfo,
        'NewQuestions':NewQuestions,
        SubmitTestForm
    },
    computed:{
        ...mapGetters(['questionsCount']),
    }

}
</script>
