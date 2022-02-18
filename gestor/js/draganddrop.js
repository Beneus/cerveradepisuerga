var dragAndDrop = ($items) =>{

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
        //e.currentTarget.style.backgroundColor = 'red';
        return false;
    }

    function handleDragEnter(e) {
        // this / e.target is the current hover target.
        //e.currentTarget.style.backgroundColor = 'blue';
    }

    function handleDragLeave(e) {
        this.classList.remove('over');  // this / e.target is previous target element.
        this.classList.remove('dragElem');
        //e.currentTarget.style.backgroundColor = 'none';
    }

    function handleDrop(e) {
        // this/e.target is current target element.

        if (e.stopPropagation) {
            e.stopPropagation(); // Stops some browsers from redirecting.
        }

        // Don't do anything if dropping the same column we're dragging.
        if (dragSrcEl != this) {

            if (this.parentNode) {
                this.parentNode.removeChild(dragSrcEl);
              }
            var dropHTML = e.dataTransfer.getData('text/html');
            var dropElem = this.previousSibling;
            this.insertAdjacentHTML('beforebegin', dropHTML);
            addDnDHandlers(dropElem);
        }
        this.classList.remove('over');
        //e.currentTarget.style.backgroundColor = 'blueviolet';
        //var cols = e.currentTarget.parentElement.children;
        var ids = [];
        // [].forEach.call(cols, function(elem){
        //     ids.push(elem.id);
        // });

        ids.push({id:this.getAttribute('fileid'),order:dragSrcEl.getAttribute('orden')});
        ids.push({id:dragSrcEl.getAttribute('fileid'),order:this.getAttribute('orden')});

        // [].forEach.call(cols, function(elem){
        //     ids.push({id:elem.getAttribute('fileid'),order:elem.getAttribute('orden')});
        // });
        updateOrder(ids);
        
        return false;
    }

    const updateOrder = (ids) => {
        $.post( "img-reorder.php", {'short':ids}, function(data){
            load();
            // $('#FormImage' + ids[0]['id']).attr('orden', ids[0]['order']);
            // $('#FormImage' + ids[1]['id']).attr('orden', ids[1]['order']);
            // $('#draggableArea > div').sort(function (a, b) {
            //     var contentA = parseInt($(a).attr('orden'), 10);
            //     var contentB = parseInt($(b).attr('orden'), 10);
            //     return (contentA > contentB) ? 1 : (contentA < contentB) ? -1 : 0;
            // }).appendTo('#draggableArea');

        });
    }


    function handleDragEnd(e) {
        // this/e.target is the source node.
        this.classList.remove('over');
        console.log(e.currentTarget)
        // e.currentTarget.style.backgroundColor = 'white';
        // [].forEach.call(cols, function(elem){
        //     elem.style.backgroundColor = 'none';
        // });
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

}