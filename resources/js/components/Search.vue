<script>
import algoliasearch from "algoliasearch/lite";
import "instantsearch.css/themes/satellite-min.css";

export default {
    props: ["id", "searchKey"],
    data() {
        return {
            searchClient: algoliasearch(this.id, this.searchKey)
        };
    }
};
</script>

<style>
body {
    font-family: sans-serif;
    padding: 1em;
}
</style>
