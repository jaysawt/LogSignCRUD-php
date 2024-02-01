 <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click", (e)=>{
                tr = e.target.parentNode.parentNode
                console.log("edit ", tr);
                edit_username=tr.getElementsByTagName("td")[0].innerText;
                console.log(edit_username);
                usernameEdit.value=edit_username;
                idEdit.value=e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');
            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element)=>{
            element.addEventListener("click", (e)=>{
                delEdit = e.target.id.substr(1,);
                if (confirm("Are you sure you want to delete?")) {
                    var form = document.createElement("form");
                    form.setAttribute("method", "post"); 
                    form.setAttribute("action", "includes/delete.inc.php"); 
                    var input = document.createElement("input");
                    input.setAttribute("type", "hidden");
                    input.setAttribute("name", "deleteId"); 
                    input.setAttribute("value", delEdit); 
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }                
                
            })
        })
    </script>

    <script>
        if (window.location.search.includes('delete=success') || window.location.search.includes('update=success') || 
            window.location.search.includes('login=success') || window.location.search.includes('signup=success')|| window.location.search.includes('logout=success')) {
            var newUrl = window.location.href.split('?')[0];
            window.history.replaceState({}, document.title, newUrl);
        }
    </script>
 
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>let table = new DataTable('#myTable');</script>    
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
