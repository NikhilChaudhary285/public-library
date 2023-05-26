// Event for edit
edits = document.getElementsByClassName('edit');
Array.from(edits).forEach((element) => {
    element.addEventListener("click", (e) => {
        console.log("edit");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        author = tr.getElementsByTagName("td")[1].innerText;
        type = tr.getElementsByTagName("td")[2].innerText;
        borrower = tr.getElementsByTagName("td")[3].innerText;
        console.log(`Name :- ${name} || Author :- ${author} || Type :- ${type} || Borrower :- ${borrower}`);
        nameEdit.value = name;
        authorEdit.value = author;
        typeEdit.value = type;
        borrowerEdit.value = borrower;

        // Edit_table_logic
        table = e.target.id.substr(0, 1);
        if (table == "i") {
            snoEdit.value = e.target.id.substr(1,);
            editTable.value = "issuedbooks";
        }
        else {
            snoEdit.value = e.target.id;
            editTable.value = "availablebooks";
        }
        console.log(`id :- ${e.target.id}`);
        $('#editModal').modal('toggle');
    })
})

// Event for borrow
borrows = document.getElementsByClassName('borrow');
Array.from(borrows).forEach((element) => {
    element.addEventListener("click", (e) => {
        console.log("borrow");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        author = tr.getElementsByTagName("td")[1].innerText;
        borrowtype = tr.getElementsByTagName("td")[2].innerText;

        console.log(`Name :- ${name}`);
        bookborrow.value = name;
        authorname.value = author;
        type.value = borrowtype;
        borrowid.value = e.target.id.substr(1,);

        console.log(`id :- ${e.target.id}`);
        $('#borrowModal').modal('toggle');
    })
})

// Event for borrower
borrowers = document.getElementsByClassName('borrower');
Array.from(borrowers).forEach((element) => {
    element.addEventListener("click", (e) => {
        console.log("borrower");
        tr = e.target.parentNode.parentNode;
        bookname = tr.getElementsByTagName("td")[0].innerText;
        borrowername = tr.getElementsByTagName("td")[4].innerText;
        borroweremail = tr.getElementsByTagName("td")[5].innerText;
        borrowerphone = tr.getElementsByTagName("td")[6].innerText;
        borroweraddress = tr.getElementsByTagName("td")[7].innerText;
        bookissuedtime = tr.getElementsByTagName("td")[8].innerText;

        console.log(`Book Name :- ${bookname} || Borrower Name :- ${borrowername} || Borrower Email :- ${borroweremail} || Borrower Phone :- ${borrowerphone} || Borrower Address :- ${borroweraddress} || Book Issued At :- ${bookissuedtime}`);
        bor_edit_name.value = borrowername;
        bor_edit_email.value = borroweremail;
        bor_edit_phone.value = borrowerphone;
        bor_edit_address.value = borroweraddress;
        bor_issued_time = bookissuedtime;

        // Showing Book_Issued_Time
        let issued_Time_Elm = document.getElementById('issued_Time');
        issued_Time_Elm.innerText = bor_issued_time;

        borrowerid.value = e.target.id.substr(2,);

        console.log(`id :- ${e.target.id}`);
        $('#borrowerModal').modal('toggle');
    })
})

// Event for return
returns = document.getElementsByClassName('return');
Array.from(returns).forEach((element) => {
    element.addEventListener("click", (e) => {
        console.log("return");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        author = tr.getElementsByTagName("td")[1].innerText;
        rettype = tr.getElementsByTagName("td")[2].innerText;
        borrower = tr.getElementsByTagName("td")[3].innerText;

        console.log(`Name :- ${name}`);
        bookreturn.value = name;
        returnauthor.value = author;
        returntype.value = rettype;
        returnborrower.value = borrower;

        returnid.value = e.target.id.substr(1,);

        console.log(`id :- ${e.target.id}`);
        $('#returnModal').modal('toggle');
    })
})

// Event for delete
deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
        console.log("delete");

        // Delete_table_logic
        table = e.target.id.substr(0, 1);
        if (table == "i") {
            snoDelete.value = e.target.id.substr(2,);
            deleteTable.value = "issuedbooks";
        }
        else {
            snoDelete.value = e.target.id.substr(1,);
            deleteTable.value = "availablebooks";
        }
        console.log(`id :- ${e.target.id}`);
        $('#deleteModal').modal('toggle');
    })
})