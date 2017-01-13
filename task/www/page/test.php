<div class="m-menu-documents">
  <!-- (data-offset-top="100", bs-affix)-->
  <div ng-repeat="item in vm.docTypes" ng-click="vm.document.docType = item.value; vm.getNumberDocument()" ng-class="{&quot;m-menu-document-item-active&quot;: vm.document.docType==item.value}" class="m-menu-documents-item"><img ng-src="../assets/images/menu_icons/realisation/{{item.img}}.svg" class="disabled"/><img ng-src="../assets/images/menu_icons/realisation/{{item.imgReverse}}.svg" class="active"/>
    <md-tooltip md-direction="bottom">{{item.value}}</md-tooltip>
  </div>
</div>
<div data-offset-top="100" bs-affix="bs-affix" class="m-menu-documents m-menu-documents-right">
  <div ng-click="vm.sendRequestSelling()" ng-class="{animation: vm.getClassValidationForSubmit()}" class="m-menu-documents-item"><img ng-src="../assets/images/menu_icons/realisation7.svg" class="disabled"/><img ng-src="../assets/images/menu_icons/realisation7-reverse.svg" class="active"/>
    <md-tooltip md-direction="bottom">Отправить</md-tooltip>
  </div>
  <div ui-sref="history" class="m-menu-documents-item"><img ng-src="../assets/images/menu_icons/realisation5.svg" class="disabled"/><img ng-src="../assets/images/menu_icons/realisation5-reverse.svg" class="active"/>
    <md-tooltip md-direction="bottom">История</md-tooltip>
  </div>
  <div ui-sref="settings" class="m-menu-documents-item"><img ng-src="../assets/images/menu_icons/settings.svg" class="disabled"/><img ng-src="../assets/images/menu_icons/settings-reverse.svg" class="active"/>
    <md-tooltip md-direction="bottom">Настройки</md-tooltip>
  </div>
  <div ng-click="vm.logout()" class="m-menu-documents-item"><img ng-src="../assets/images/menu_icons/realisation6.svg" class="disabled"/><img ng-src="../assets/images/menu_icons/realisation6-reverse.svg" class="active"/>
    <md-tooltip md-direction="bottom">Выйти</md-tooltip>
  </div>
</div>
<div layout="row" class="m-row m-document">
  <div flex="80">
    <h1 class="text-header">{{vm.document.docType}} №&nbsp;</h1>
    <input ng-disabled="true" type="text" ng-model="vm.document.number" class="text-header--input"/>
  </div>
  <div flex="20">
    <datepicker date-format="от dd MMMM yyyy г." class="m-datepicker">
      <input ng-model="vm.document.date" type="text" class="m-input-picker"/>
    </datepicker>
  </div>
</div>
<m-type-client ng-if="vm.document.docType" m-contragent="vm.document.contragent"></m-type-client>
<div ng-if="vm.document.docType" ng-mouseover="vm.document.invalid = false;">
  <div class="like-invoice-title">
    <div ng-class="vm.getClassValidation()" class="m-point"></div>{{ vm.document.docType }}
  </div>
  <div class="like-invoice-body m-table">
    <div layout="row" ng-if="vm.document.docType==&quot;Счет-фактура&quot;||vm.document.docType==&quot;Счет на оплату&quot;" class="m-row m-table-header">
      <div flex="5" class="m-col">№</div>
      <div flex="5" class="m-col">Код</div>
      <div flex="30" class="m-col">Наименование</div>
      <div flex="10" class="m-col">Кол-во</div>
      <div flex="15" class="m-col">Единица</div>
      <div flex="10" class="m-col">Цена</div>
      <div flex="15" class="m-col">Валюта</div>
      <div flex="15" class="m-col">Сумма</div>
      <div flex="5" class="m-col">
        <!-- empty col-->
      </div>
    </div>
    <div layout="row" ,="," ng-if="vm.document.docType==&quot;Счет-фактура&quot;||vm.document.docType==&quot;Счет на оплату&quot;" ng-repeat="item in vm.document.items track by $index" class="m-row m-table-row">
      <div flex="5" class="m-col m-col-format">{{item.index}}</div>
      <div flex="5" class="m-col">
        <div class="m-input-container">
          <input ng-class="{'deactiveDashed': item.code}" required="" name="clientName" ng-model="item.code"/>
        </div>
      </div>
      <div flex="30" class="m-col">
        <div class="m-input-container">
          <textarea ng-model="item.name" ng-class="{'deactiveDashed': item.name }" required="" name="companyName" dynamic-text-area="dynamic-text-area" msd-elastic="msd-elastic"></textarea>
        </div>
      </div>
      <!-- количество-->
      <div flex="10" class="m-col">
        <div class="m-input-container">
          <input ng-class="{'deactiveDashed': item.count}" required="" type="number" name="clientName" ng-model="item.count" ng-blur="vm.calculateItem(item)"/>
        </div>
      </div>
      <!-- еденица-->
      <div flex="15" class="m-col">
        <div style="padding-top: 5px;" class="m-input-container">
          <button type="button" ng-model="item.unit" placeholder="" data-html="1" data-toggle="true" bs-options="item.value as item.label for item in vm.units" bs-select="" class="m-select"><span class="caret"></span></button>
        </div>
      </div>
      <!-- Цена-->
      <div flex="10" class="m-col">
        <div class="m-input-container">
          <input ng-class="{'deactiveDashed': item.price}" required="" type="number" name="clientName" ng-model="item.price" ng-blur="vm.calculateItem(item)"/>
        </div>
      </div>
      <!-- Валюта-->
      <div flex="15" class="m-col">
        <div style="padding-top: 5px;" class="m-input-container">
          <button type="button" ng-model="item.currency" placeholder="" data-html="1" data-toggle="true" bs-options="item.value as item.label for item in vm.currencys" bs-select="" class="m-select"><span class="caret"></span></button>
        </div>
      </div>
      <!-- Сумма-->
      <div flex="15" class="m-col">
        <div class="m-input-container">
          <input ng-class="{'deactiveDashed': item.summ}" required="" type="number" name="clientName" ng-model="item.summ" ng-disabled="true"/>
        </div>
      </div>
      <div style="text-align: right;" flex="5" ng-class="{&quot;m-remove-row&quot;: $index&gt;0}" ng-click="vm.clickToCross($index)" class="m-col m-plus-row">+</div>
    </div>
    <div ng-if="vm.document.docType=='Счет на оплату'">
      <div class="m-padding-bottom">Cделать счет на оплату</div>
      <div layout="row" layout-wrap="layout-wrap" flex="flex">
        <div class="checkbox">
          <label>
            <input type="checkbox" ng-model="vm.document.naOsnovaniiDogovora" value=""/>На основании договора
          </label>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" ng-model="vm.document.sdelatShetFacturu" value=""/>Cделать Cчет-фактуру
          </label>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" ng-model="vm.document.sdelatNakladnuy" value=""/>Cделать Накладную / Акт
          </label>
        </div>
      </div>
    </div>
    <div ng-if="vm.document.docType==&quot;Счет-фактура&quot;||vm.document.docType==&quot;Накладная&quot;||vm.document.docType==&quot;Акт выполненных работ&quot;">
      <!--div.m-padding-bottom На основании-->
      <div layout="row" layout-wrap="layout-wrap" flex="flex">
        <div style="padding-top: 5px;" class="m-input-container">
          <label>На основании</label><br/>
          <button type="button" ng-model="vm.document.naOsnovanii" placeholder="" data-html="1" data-toggle="true" bs-options="item.value as item.label for item in vm.osnovanie" bs-select="" class="m-select"><span class="caret"></span></button>
        </div>
        <!--div.m-input-container(flex='50')-->
        <!---->
        <!--  input(ng-class="{'deactiveDashed': vm.mContragent.companyName }",-->
        <!--  type="text",-->
        <!--  ng-model="vm.mContragent.companyName",-->
        <!--  bs-options="item.value as item.value for item in vm.contragents",-->
        <!--  bs-on-select= 'vm.selectContragent'-->
        <!--  bs-typeahead)-->
        <!--.radio(ng-if='vm.document.docType=="Счет-фактура"')-->
        <!--  label-->
        <!--    input(type='radio', name='optradio', ng-model='vm.document.naOsnovanii', value="Договора")-->
        <!--    | Договора-->
        <!--.radio-->
        <!--  label-->
        <!--    input(type='radio', name='optradio', ng-model='vm.document.naOsnovanii', value="Счет на оплату")-->
        <!--    | Счет на оплату-->
        <!--.radio(ng-if='vm.document.docType=="Счет-фактура"')-->
        <!--  label-->
        <!--    input(type='radio', name='optradio', ng-model='vm.document.naOsnovanii', value="Доверенности")-->
        <!--    | Доверенности-->
        <!--.radio(ng-if='vm.document.docType=="Счет-фактура"')-->
        <!--  label-->
        <!--    input(type='radio', name='optradio', ng-model='vm.document.naOsnovanii', value="Без договора")-->
        <!--    | Без договора-->
        <!--.radio(ng-if='vm.document.docType=="Накладная"||vm.document.docType=="Акт выполненных работ"')-->
        <!--  label-->
        <!--    input(type='radio', name='optradio', ng-model='vm.document.naOsnovanii', value="Счет-фактура")-->
        <!--    | Счет-фактура-->
      </div>
      <div layout="row" class="m-row">
        <div flex="50" ng-if="vm.document.naOsnovanii==&quot;Счет на оплату&quot;" class="m-input-container">
          <label>Счет на оплату</label><br/>
          <input type="file" ng-model="vm.document.schetNaOplatu" base-sixty-four-input="base-sixty-four-input"/>
        </div>
        <div flex="50" ng-if="vm.document.naOsnovanii==&quot;Доверенности&quot;" class="m-input-container">
          <label>Доверенности</label><br/>
          <input type="file" ng-model="vm.document.doverennost" base-sixty-four-input="base-sixty-four-input"/>
        </div>
        <div flex="50" ng-if="vm.document.naOsnovanii==&quot;Счет-фактура&quot;" class="m-input-container">
          <label>Счет-фактура</label><br/>
          <input type="file" ng-model="vm.document.shetFactura" base-sixty-four-input="base-sixty-four-input"/>
        </div>
      </div>
    </div>
    <div ng-if="vm.document.naOsnovaniiDogovora||vm.document.naOsnovanii==&quot;Договора&quot; &amp;&amp; vm.document.docType!=&quot;Накладная&quot; &amp;&amp; vm.document.docType!=&quot;Акт выполненных работ&quot;">
      <!--div.like-invoice-title На основании договора-->
      <div layout="row" class="m-row">
        <div flex="50" class="m-input-container">
          <label>Номер договора</label>
          <input required="" name="clientName" ng-model="vm.document.osnovanie.nomerDogovora"/>
        </div>
        <div flex="50" class="m-input-container">
          <label>Дата договора</label>
          <datepicker date-format="dd MMMM yyyy" class="m-datepicker">
            <input ng-model="vm.document.osnovanie.date" type="text" class="m-input-picker"/>
          </datepicker>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="like-invoice-title">
  <div class="m-point"></div>Дополнительные требования:
</div>
<div class="like-invoice-body">
  <div layout="row" class="m-row">
    <div flex="50" class="m-input-container">
      <label>Дополнительная информация</label><br/>
      <textarea ng-class="{'deactiveDashed': vm.document.description }" required="" name="description" ng-model="vm.document.description" dynamic-text-area="dynamic-text-area" msd-elastic="msd-elastic"></textarea>
    </div>
    <div flex="50" class="m-input-container">
      <div flex="100" ng-if="vm.document.docType==&quot;Счет-фактура&quot;" class="checkbox checkbox-coll">
        <label>
          <input type="checkbox" ng-model="vm.document.dopSformirovat.nakladnaya" value=""/>Сформировать накладную
        </label>
      </div>
      <div flex="100" ng-if="vm.document.docType==&quot;Счет-фактура&quot;" class="checkbox checkbox-coll">
        <label>
          <input type="checkbox" ng-model="vm.document.dopSformirovat.prihodnik" value=""/>Сформировать приходник
        </label>
      </div>
      <div flex="100" class="checkbox checkbox-coll">
        <label>
          <input type="checkbox" ng-model="vm.document.sendCopyToContragent" value=""/>Копию отправить контрагенту
        </label>
      </div>
      <div flex="100" class="checkbox checkbox-coll">
        <label>
          <input type="checkbox" ng-model="vm.document.sendOriginalTOContragent" value=""/>Отправить оригинал по почте контрагенту
        </label>
      </div>
      <div flex="100" class="checkbox checkbox-coll">
        <label>
          <input type="checkbox" ng-model="vm.document.srochno" value=""/>Требуется — СРОЧНО!
        </label>
      </div>
    </div>
  </div>
  <div ng-if="vm.document.sendCopyToContragent">
    <div layout="row" class="m-row">
      <div flex="50" class="m-input-container">
        <label> Почта контрагента</label>
        <input required="required" type="email" name="clientName" ng-model="vm.document.emailContragent" ng-pattern="/^.+@.+..+$/"/>
      </div>
      <div flex="50" class="m-input-container">
        <label>Контактное лицо</label>
        <input required="required" type="text" name="clientName" ng-model="vm.document.nameContragent"/>
      </div>
    </div>
  </div>
</div>
<div ng-if="vm.document.sendOriginalTOContragent">
  <div class="like-invoice-title">
    <div class="m-point"></div>Доставка документов
  </div>
  <div class="like-invoice-body">
    <div layout="row">
      <div class="m-padding-bottom">Доставка документов от двери до двери. Цена — 600 тенге за 1 доставку по городу Алматы. Направление Астана / Караганда — 1600 тенге в одну сторону. Другие направления по РК — 1800 тенге в одну сторону.</div>
    </div>
    <!--Доставить контрагенту   Забрать у контрагента   Поручить контроль MD-->
    <div layout="row" layout-wrap="layout-wrap" flex="flex">
      <div class="checkbox">
        <label>
          <input type="checkbox" ng-model="vm.document.sendContragent" value=""/>Доставить контрагенту
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" ng-model="vm.document.reciveToContragent" value=""/>Забрать у контрагента
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" ng-model="vm.document.entrustToMD" value=""/>Поручить контроль MD
        </label>
      </div>
    </div>
    <div layout="row" class="m-row">
      <div flex="40" class="m-input-container">
        <label>Ответственное лицо</label>
        <input required="" name="email" ng-model="vm.document.clientName"/>
      </div>
      <div flex="30" class="m-input-container">
        <label>Контактный телефон</label>
        <input required="" name="phone" ng-model="vm.document.contactPhone" ng-pattern="/^+7 [(][0-9]{3}[)] [0-9]{3}-[0-9]{4}$/" ui-mask="+7 (999) 999-9999" ui-mask-placeholder="" ui-mask-placeholder-char="_"/>
      </div>
    </div>
  </div>
</div>
<div ng-if="vm.document.srochno">
  <div class="like-invoice-title">Условие срочных заявок</div>
  <div class="like-invoice-body">
    <div layout="row">
      <div>Срочная заявка обрабатывается в течении 15 минут. Цена — 500 тенге за 1 заявку.</div>
    </div>
  </div>
</div>