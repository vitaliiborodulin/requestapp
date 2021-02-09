<div id="requestapp">
    <form>
        <div class="form-group">
            <label for="requestapp_name">ФИО</label>
            <input type="text" class="form-control" name="requestapp_name" id="requestapp_name" placeholder="Петров Иван Иванович" required>
        </div>
        <div class="form-group">
            <label for="requestapp_email">Email</label>
            <input type="email" class="form-control" name="requestapp_email" id="requestapp_email" placeholder="mail@mail.ru" required>
        </div>
        <div class="form-group">
            <label for="requestapp_list">Выбор УНУ</label>
            <select class="form-control" name="requestapp_list" id="requestapp_list"  required>
                <option disabled="" selected="" value=''>выберите УНУ</option>
                <option value="Гербарий">Гербарий Полярно-альпийского ботанического сада-института (KPABG)</option>
                <option value="Инсектарий">Инсектарий Полярно-альпийского ботаничкого сада-института</option>
                <option value="Коллекция растений">Коллекция живых растений Полярно-альпийского ботанического сада-института</option>
            </select>
            <span class="help-block">Выберите из списка необходимую услугу<span>
        </div>
        <input type="hidden" name="requestapp_status" value="Первичный">
        <div class="form-group">
            <label for="requestapp_text">Содержание заявки</label>
            <textarea class="form-control" name="requestapp_text" id="requestapp_text" rows="8" required placeholder="Напишите тут текст вашей заявки"></textarea>
            <span class="help-block">Впишите тут информацию о планируемых исследованиях, работах (услугах) и ориентировочных сроках их выполнения, а также иную информацию, необходимую для планирования использования оборудования с учётом специфики его функционирования.</span>
        </div>
        <button type="submit" class="btn btn-default">Добавить заявку</button>
    </form>
</div>
