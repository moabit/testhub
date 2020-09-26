import Vuex from 'vuex';
import Vue from 'vue';
import question from "./modules/question";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        question
    },
    state: {
        hasTimeLimit: false,
        timeLimit: false,
        tags: [],
        questions: [
            {
                id: 1,
                text: 'hue',
                answers: [{text: 'Понасенков', isTrue: true}, {text: 'Соколов', isTrue: false}, {
                    text: 'Горбачев',
                    isTrue: false
                }]
            },
            {id: 2, text: 'Какое имя Понасенкова?', answers: [{text: 'Евгений', isTrue: true}]}
        ],
        passRate: 30
    },
    mutations: {
        switchTimeLimit: state => {
            state.hasTimeLimit = !state.hasTimeLimit;
            state.timeLimit = null;
        },
        addTag: (state, tag) => {
            state.tags.push(tag);
        },
        deleteTag: (state, tag) => {
            let index = state.tags.findIndex(el => tag == el);
            state.tags.splice(index, 1);
        },
        updateAnswersQuantity: (state, payload) => {
            let question = state.questions.find(question => question.id === payload.id);
            if (question.answers.length - payload.value > 0) {
                for (let i = 0; i < question.answers.length - payload.value; i++) {
                    question.answers.pop();
                }
            } else {
                for (let i = 0; i < payload.value - question.answers.length; i++) {
                    question.answers.push({});
                }
            }
        },
        addQuestion: (state) => {
            let idArray = [];
            state.questions.forEach(question => idArray.push(question.id))
            let maxId = Math.max.apply(Math, idArray);
            state.questions.push({id: maxId + 1, text: '', answers: []});
        },
        changeQuestionType: (state, payload) => {

        },
        deleteQuestion: (state, id) => {
            let questionIndex = state.questions.findIndex(question => question.id === id);
            state.questions.splice(questionIndex, 1);
        },
        changePassRate: (state, value) => {
            console.log(state.passRate);
            state.passRate = value;
        }
    },
    getters: {
        answersCount: state => id => {
            return state.questions.find(question => question.id === id).answers.length;
        },
        questionsCount: state => {
            return state.questions.length;
        }

    }

})
