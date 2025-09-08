document.addEventListener("DOMContentLoaded",function(y){let c,l,p,u,n;c=config.colors.textMuted,l=config.colors.headingColor,p=config.colors.borderColor,u=config.colors.bodyColor,n=config.fontFamily;const i={donut:{series1:config.colors.success,series2:"color-mix(in sRGB, "+config.colors.success+" 80%, "+config.colors.cardColor+")",series3:"color-mix(in sRGB, "+config.colors.success+" 60%, "+config.colors.cardColor+")",series4:"color-mix(in sRGB, "+config.colors.success+" 40%, "+config.colors.cardColor+")"},line:{series1:config.colors.warning,series2:config.colors.primary}},d=document.querySelector("#shipmentStatisticsChart"),b={series:[{name:"Shipment",type:"column",data:[38,45,33,38,32,50,48,40,42,37]},{name:"Delivery",type:"line",data:[23,28,23,32,28,44,32,38,26,34]}],chart:{height:320,type:"line",stacked:!1,parentHeightOffset:0,toolbar:{show:!1},zoom:{enabled:!1}},markers:{size:5,colors:[config.colors.white],strokeColors:i.line.series2,hover:{size:6},borderRadius:4},stroke:{curve:"smooth",width:[0,3],lineCap:"round"},legend:{show:!0,position:"bottom",markers:{size:4,offsetX:-3,strokeWidth:0},height:40,itemMargin:{horizontal:10,vertical:0},fontSize:"15px",fontFamily:n,fontWeight:400,labels:{colors:l,useSeriesColors:!1},offsetY:5},grid:{strokeDashArray:8,borderColor:p},colors:[i.line.series1,i.line.series2],fill:{opacity:[1,1]},plotOptions:{bar:{columnWidth:"30%",startingShape:"rounded",endingShape:"rounded",borderRadius:4}},dataLabels:{enabled:!1},xaxis:{tickAmount:10,categories:["1 Jan","2 Jan","3 Jan","4 Jan","5 Jan","6 Jan","7 Jan","8 Jan","9 Jan","10 Jan"],labels:{style:{colors:c,fontSize:"13px",fontFamily:n,fontWeight:400}},axisBorder:{show:!1},axisTicks:{show:!1}},yaxis:{tickAmount:4,min:0,max:50,labels:{style:{colors:c,fontSize:"13px",fontFamily:n,fontWeight:400},formatter:function(e){return e+"%"}}},responsive:[{breakpoint:1400,options:{chart:{height:320},xaxis:{labels:{style:{fontSize:"10px"}}},legend:{fontSize:"13px"}}},{breakpoint:1025,options:{chart:{height:415},plotOptions:{bar:{columnWidth:"50%"}}}},{breakpoint:982,options:{plotOptions:{bar:{columnWidth:"30%"}}}},{breakpoint:480,options:{chart:{height:250},legend:{offsetY:7}}}]};typeof d!==void 0&&d!==null&&new ApexCharts(d,b).render();const f=document.querySelector("#deliveryExceptionsChart"),g={chart:{height:396,parentHeightOffset:0,type:"donut"},labels:["Incorrect address","Weather conditions","Federal Holidays","Damage during transit"],series:[13,25,22,40],colors:[i.donut.series1,i.donut.series2,i.donut.series3,i.donut.series4],stroke:{width:0},dataLabels:{enabled:!1,formatter:function(e,r){return parseInt(e)+"%"}},legend:{show:!0,position:"bottom",offsetY:10,markers:{size:5},itemMargin:{horizontal:15,vertical:5},fontSize:"13px",fontFamily:n,fontWeight:400,labels:{colors:l,useSeriesColors:!1}},tooltip:{theme:!1},grid:{padding:{top:15}},plotOptions:{pie:{donut:{size:"77%",labels:{show:!0,value:{fontSize:"24px",fontFamily:n,color:l,fontWeight:500,offsetY:-20,formatter:function(e){return parseInt(e)+"%"}},name:{offsetY:30,fontFamily:n},total:{show:!0,fontSize:"15px",fontFamily:n,color:u,label:"AVG. Exceptions",formatter:function(e){return"30%"}}}}}},responsive:[{breakpoint:1025,options:{chart:{height:380}}}]};typeof f!==void 0&&f!==null&&new ApexCharts(f,g).render();const h=document.querySelector(".dt-route-vehicles");h&&new DataTable(h,{ajax:assetsPath+"json/logistics-dashboard.json",columns:[{data:"id"},{data:"id",orderable:!1,render:DataTable.render.select()},{data:"location"},{data:"start_city"},{data:"end_city"},{data:"warnings"},{data:"progress"}],columnDefs:[{className:"control",orderable:!1,searchable:!1,responsivePriority:2,targets:0,render:function(e,r,o,t){return""}},{targets:1,orderable:!1,searchable:!1,responsivePriority:3,checkboxes:!0,render:function(){return'<input type="checkbox" class="dt-checkboxes form-check-input">'},checkboxes:{selectAllRender:'<input type="checkbox" class="form-check-input">'}},{targets:2,responsivePriority:1,render:(e,r,o)=>{const t=o.location;return`
                  <div class="d-flex justify-content-start align-items-center user-name">
                      <div class="avatar-wrapper">
                          <div class="avatar me-4">
                              <span class="avatar-initial rounded-circle bg-label-secondary">
                                  <i class="icon-base bx bxs-truck icon-lg"></i>
                              </span>
                          </div>
                      </div>
                      <div class="d-flex flex-column">
                        <a class="text-heading text-nowrap fw-medium" href="${baseUrl}app/logistics/fleet">VOL-${t}</a>
                      </div>
                  </div>
              `}},{targets:3,render:(e,r,o)=>{const{start_city:t,start_country:s}=o;return`
                  <div class="text-body">
                      ${t}, ${s}
                  </div>
              `}},{targets:4,render:(e,r,o)=>{const{end_city:t,end_country:s}=o;return`
                  <div class="text-body">
                      ${t}, ${s}
                  </div>
              `}},{targets:-2,render:(e,r,o)=>{const t=o.warnings,a={1:{title:"No Warnings",class:"bg-label-success"},2:{title:"Temperature Not Optimal",class:"bg-label-warning"},3:{title:"Ecu Not Responding",class:"bg-label-danger"},4:{title:"Oil Leakage",class:"bg-label-info"},5:{title:"Fuel Problems",class:"bg-label-primary"}}[t];return a?`
                  <span class="badge rounded ${a.class}">
                      ${a.title}
                  </span>
              `:e}},{targets:-1,render:(e,r,o)=>{const t=o.progress;return`
                  <div class="d-flex align-items-center">
                      <div class="progress w-100" style="height: 8px;">
                          <div
                              class="progress-bar"
                              role="progressbar"
                              style="width: ${t}%"
                              aria-valuenow="${t}"
                              aria-valuemin="0"
                              aria-valuemax="100">
                          </div>
                      </div>
                      <div class="text-body ms-3">${t}%</div>
                  </div>
              `}}],select:{style:"multi",selector:"td:nth-child(2)"},order:[2,"asc"],layout:{topStart:{rowClass:"",features:[]},topEnd:{},bottomStart:{rowClass:"row mx-3 justify-content-between",features:["info"]},bottomEnd:"paging"},lengthMenu:[5],language:{paginate:{next:'<i class="icon-base bx bx-chevron-right scaleX-n1-rtl icon-18px"></i>',previous:'<i class="icon-base bx bx-chevron-left scaleX-n1-rtl icon-18px"></i>',first:'<i class="icon-base bx bx-chevrons-left scaleX-n1-rtl icon-18px"></i>',last:'<i class="icon-base bx bx-chevrons-right scaleX-n1-rtl icon-18px"></i>'}},responsive:{details:{display:DataTable.Responsive.display.modal({header:function(e){return"Details of "+e.data().location}}),type:"column",renderer:function(e,r,o){const t=o.map(function(s){return s.title!==""?`<tr data-dt-row="${s.rowIndex}" data-dt-column="${s.columnIndex}">
                      <td>${s.title}:</td>
                      <td>${s.data}</td>
                    </tr>`:""}).join("");if(t){const s=document.createElement("div");s.classList.add("table-responsive");const a=document.createElement("table");s.appendChild(a),a.classList.add("table");const m=document.createElement("tbody");return m.innerHTML=t,a.appendChild(m),s}return!1}}}}),setTimeout(()=>{[{selector:".dt-layout-start",classToAdd:"my-0"},{selector:".dt-layout-end",classToAdd:"my-0"},{selector:".dt-layout-table",classToRemove:"row mt-2",classToAdd:"mt-n2"}].forEach(({selector:r,classToRemove:o,classToAdd:t})=>{document.querySelectorAll(r).forEach(s=>{o&&o.split(" ").forEach(a=>s.classList.remove(a)),t&&t.split(" ").forEach(a=>s.classList.add(a))})})},100)});
