let origin = window.origin;
document.getElementById('_c').addEventListener('click',(e)=>{
    e.preventDefault();
    var form = document.getElementById('_p_f');
    var _f = new FormData(form);
    
    var product_name = _f.get('name');
    var product_price = _f.get('price');
    var product_quantity = _f.get('quantity');

    if( product_name == '' || product_price == '' || product_quantity == '' )
    {
        alert('please fill up the form proplery first');
        return;
    }
    else if ( e.target.dataset.edit == 'false' )
    {
        let url =  origin +'/create';
        fetch(url, {
        method: 'post',
        headers: {
            'Accept': 'application/json, text/plain, */*',
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
        },
        body: 'name='+product_name+'&'+'price='+product_price+'&'+'quantity='+product_quantity,
        })
        .then((data) => data.json())
        .then((data) => {
            if( data.status == 'true')
            {
                let parent_continer = document.getElementById('data_body');
                let tr = document.createElement('tr');
                tr.classList.add("row100");
    
                let td1 = document.createElement('td');
                td1.innerText = data.product.name;
                td1.classList.add("column100", "column1");
    
                let td2 = document.createElement('td');
                td2.innerText = data.product.quantity_in_stock;
                td2.classList.add("column100", "column2");
    
                let td3 = document.createElement('td');
                td3.innerText = data.product.price;
                td3.classList.add("column100", "column3");
    
                let td4 = document.createElement('td');
                td4.innerText = data.product.created_at;
                td4.classList.add("column100", "column4");
    
                let td5 = document.createElement('td');
                td5.innerText = data.product.total_val_num;
                td5.classList.add("column100", "column5");
    
                let td6 = document.createElement('td');
                td6.classList.add("column100", "column7");
    
                let a1 = document.createElement('a');
                a1.classList.add("ed");
                a1.setAttribute('href','#');

                let a2 = document.createElement('a');
                a2.classList.add("del");
                a2.setAttribute('href','#');

                let i1 = document.createElement('i');
                i1.classList.add("fa", "fa-pencil");
                i1.dataset.id = data.product.id;
                i1.dataset.btn = 'e';

                let i2 = document.createElement('i');
                i2.classList.add("fa", "fa-trash");
                i2.dataset.id = data.product.id;
                i2.dataset.btn = 'd';
                
                a1.appendChild(i1);
                a2.appendChild(i2);
                td6.appendChild(a1);
                td6.appendChild(a2);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);

                if( parent_continer.hasChildNodes() )
                {
                    parent_continer.insertBefore(tr,parent_continer.firstChild); 
                }
                else
                {
                    parent_continer.appendChild(tr);
                }
                form.reset();
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
    else if( e.target.dataset.edit == 'true' )
    {
        if ( e.target.dataset.id != '' )
        {
            let url =  origin +'/edit';
            fetch(url, {
            method: 'post',
            headers: {
                'Accept': 'application/json, text/plain, */*',
                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            body: 'name='+product_name+'&'+'price='+product_price+'&'+'quantity='+product_quantity+'&'+'id='+e.target.dataset.id,
            })
            .then((data) => data.json())
            .then((data) => {
                if( data.status == 'true' )
                {
                    form.reset();
                    let tr_id = 'u_' + e.target.dataset.id;
                    let find_tr = document.getElementById(tr_id);
                    if( find_tr.hasChildNodes() )
                    {
                        for( let i=0; i<find_tr.childNodes.length; i++)
                        {
                            if( i == 0 )
                            {
                                find_tr.children[i].innerText = data.product.name;
                            }
                            else if( i == 1 )
                            {
                                find_tr.children[i].innerText = data.product.quantity_in_stock;
                            }
                            else if( i == 2 )
                            {
                                find_tr.children[i].innerText = data.product.price;
                            }
                            else if( i == 4 )
                            {
                                find_tr.children[i].innerText = data.product.total_val_num;
                            }
                            else
                            {
                                continue;
                            }
                        }
                    }
                    document.getElementById('_cancel').style.visibility = 'hidden';
                    document.getElementById(tr_id).removeAttribute('id');
                    resetAll();
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }   
    }
     
});

try {
    document.getElementById('data_body').addEventListener('click',(e)=>{
        e.preventDefault();
        if ( e.target.tagName == 'I' )
        {
            var p_id = e.target.dataset.id;
            if ( e.target.dataset.btn == 'e' )
            {
                let url = origin + '/edit?id='+ p_id;
                fetch(url,{
                    method: 'get',
                    headers: {
                        'Accept': 'application/json, text/plain, */*',
                        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
                    },
                })
                .then( (data) => data.json() )
                .then( (data) => {
                    if( data.status == 'true' )
                    {
                        var form = document.getElementById('_p_f');
                        form.elements['name'].value = data.product.name;
                        form.elements['price'].value = data.product.price;
                        form.elements['quantity'].value = data.product.quantity_in_stock;

                        var btn1 = document.getElementById('_c');
                        btn1.classList.replace('btn-success','btn-warning');
                        btn1.dataset.edit = true;
                        btn1.dataset.id = p_id;
                        btn1.innerText = 'Update';
                        

                        var cl_tr = e.target.closest('tr'),
                            cl_tr_id = 'u_' + p_id;
                        cl_tr.setAttribute('id',cl_tr_id);

                        var btn2 = document.getElementById('_cancel');
                        btn2.style.visibility = 'visible';
                        btn2.dataset.updateid = cl_tr_id;
                    }
                } )
                .catch( (e) => {
                    console.log( 'error: ', e);
                } );
            }
            else if( e.target.dataset.btn == 'd')
            {
                let prompt = confirm('Are you sure you want to delete?');
                if ( prompt )
                {
                    let url =  origin +'/delete';
                    fetch(url, {
                    method: 'post',
                    headers: {
                        'Accept': 'application/json, text/plain, */*',
                        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
                    },
                    body: 'id='+p_id,
                    })
                    .then((data) => data.json())
                    .then((data) => {
                        if( data.status)
                        {
                            e.target.closest('tr').remove();
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
                }
            }
        }
    });
} catch (error) {}

document.getElementById('_cancel').addEventListener('click',(e)=>{
    e.preventDefault();
    e.target.style.visibility = 'hidden';
    document.getElementById(e.target.dataset.updateid).removeAttribute('id');
    e.target.removeAttribute('data-updateid');
    resetAll();
});

function resetAll()
{
    document.getElementById('_p_f').reset();
    var btn = document.getElementById('_c');
    btn.classList.replace('btn-warning', 'btn-success');
    btn.dataset.edit = false;
    btn.removeAttribute('data-id');
    btn.innerText = 'Add';
}
