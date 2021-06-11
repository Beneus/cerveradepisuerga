(function ($items) {
    var dragSrcEl = null;
    var lastId;
    function handleDragStart(e) {
        lastId = e.currentTarget.parentElement.lastElementChild;
        // Target (this) element is the source node.
        dragSrcEl = this;
        //e.currentTarget.style.backgroundColor = 'red';
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.outerHTML);

        this.classList.add('dragElem');
    }
    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault(); // Necessary. Allows us to drop.
        }
        this.classList.add('over');

        e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.
        //e.currentTarget.style.backgroundColor = 'blueviolet';
        return false;
    }

    function handleDragEnter(e) {
        // this / e.target is the current hover target.
        //e.currentTarget.style.backgroundColor = 'blue';
    }

    function handleDragLeave(e) {
        this.classList.remove('over');  // this / e.target is previous target element.
        //e.currentTarget.style.backgroundColor = 'blueviolet';
    }

    function handleDrop(e) {
        // this/e.target is current target element.

        if (e.stopPropagation) {
            e.stopPropagation(); // Stops some browsers from redirecting.
        }

        // Don't do anything if dropping the same column we're dragging.
        if (dragSrcEl != this) {
            // Set the source column's HTML to the HTML of the column we dropped on.
            //alert(this.outerHTML);
            //dragSrcEl.innerHTML = this.innerHTML;
            //this.innerHTML = e.dataTransfer.getData('text/html');
            this.parentNode.removeChild(dragSrcEl);
            var dropHTML = e.dataTransfer.getData('text/html');
            var dropElem;
            this.insertAdjacentHTML('beforebegin', dropHTML);
            dropElem = this.previousSibling;
            // if (this == lastId) {
            //     this.insertAdjacentHTML('afterend', dropHTML);
            //     dropElem = this.nextSibling;
            // } else {
            //     this.insertAdjacentHTML('beforebegin', dropHTML);
            //     dropElem = this.previousSibling;
            // }
            addDnDHandlers(dropElem);
            //dropElem.style.backgroundColor = 'blueviolet';
        }
        this.classList.remove('over');
        //e.currentTarget.style.backgroundColor = 'blueviolet';
        var cols = e.currentTarget.parentElement.children;
        var ids = [];
        [].forEach.call(cols, function(elem){
            ids.push(elem.id);
        });
        
        updateOrder(ids);
        return false;
    }

    const updateOrder = (ids) => {
        console.log(ids);
    }


    function handleDragEnd(e) {
        // this/e.target is the source node.
        this.classList.remove('over');
        // console.log(e.currentTarget)
        e.currentTarget.style.backgroundColor = '';
        /*[].forEach.call(cols, function (col) {
            col.classList.remove('over');
        });*/
        //e.currentTarget.style.backgroundColor = 'blueviolet';
        

    }

    function addDnDHandlers(elem) {
        elem.draggable = true;
        elem.addEventListener('dragstart', handleDragStart, false);
        elem.addEventListener('dragenter', handleDragEnter, false)
        elem.addEventListener('dragover', handleDragOver, false);
        elem.addEventListener('dragleave', handleDragLeave, false);
        elem.addEventListener('drop', handleDrop, false);
        elem.addEventListener('dragend', handleDragEnd, false);
        
    }

    var cols = document.querySelectorAll($items);
    [].forEach.call(cols, addDnDHandlers);

})('#draggableArea .dragChild')