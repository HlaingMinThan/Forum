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
.ais-Highlight-highlighted {
    background-color: yellow;
}
</style>
