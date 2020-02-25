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

            let td1 = document.createElement('td');
            td1.innerText = data.product.name;

            let td2 = document.createElement('td');
            td2.innerText = data.product.quantity_in_stock;

            let td3 = document.createElement('td');
            td3.innerText = data.product.price;

            let td4 = document.createElement('td');
            td4.innerText = data.product.created_at;

            let td5 = document.createElement('td');
            td5.innerText = data.product.total_val_num;

            let td6 = document.createElement('td');

            let btn1= document.createElement('button');
            btn1.type = 'button';
            let btn_cls_1 = [ "btn", "btn-primary", "btn-sm" ];
            btn1.classList.add(...btn_cls_1);
            btn1.dataset.id = data.product.id;
            btn1.dataset.btn = 'e';
            btn1.innerText = 'Edit';

            let btn2 = document.createElement('button');
            btn2.type = 'button';
            let btn_cls_2 = [ "btn", "btn-danger", "btn-sm" ];
            btn2.classList.add(...btn_cls_2);
            btn2.dataset.id = data.product.id;
            btn2.dataset.btn = 'd';
            btn2.innerText = 'Delete';

            td6.appendChild(btn1);
            td6.appendChild(btn2);
            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
            tr.appendChild(td5);
            tr.appendChild(td6);
            parent_continer.insertBefore(tr,parent_continer.firstChild);
            form.reset();
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

try {
    document.getElementById('data_body').addEventListener('click',(e)=>{
        if ( e.target.tagName == 'BUTTON' )
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
                    console.log(data);
                    var form = document.getElementById('_p_f');
                    var _f = new FormData(form);
                    console.log(_f);
                    _f.append('name','name');
                    _f.append('price','12');
                } )
                .catch( (e) => {
                    console.log( 'error: ', e);
                } );
            }
            else if( e.target.dataset.btn == 'd')
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
    });
} catch (error) {}

