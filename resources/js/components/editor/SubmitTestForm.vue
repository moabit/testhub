<template>
    <div class="row justify-content-end">
        <div class="col-3 m-3">
            <input type="hidden" name="_token" :value="csrf">
            <button type="submit" class="btn btn-danger">Завершить создание теста</button>
        </div>
    </div>

</template>

<script>
export default {
    name: "SubmitTestForm",
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
}
</script>

<style scoped>

</style>
