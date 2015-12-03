<?php
    $nameBase = "vra-element[{$omekaElement->id}]";
    $ignoreAttributes =  get_option('vra-core-ignore-attributes');
?>
<div class='vra-data'>
    <?php if(! $ignoreAttributes): ?>
    <div class='vra-attributes'>
        <label class='vra-attributes-label'>Display Element Attributes</label>
        <?php echo $this->partial('element-attribute-form.php', 
                array(
                     'attributeNames'   => $globalAttributes,
                     'attributeObjects' => $attributeObjects,
                     'nameBase'         => $nameBase . "[display]"
                     )
                );
        ?>
    </div>
    <?php endif; ?>

    <label class='vra-notes-element-label'><?php echo __('Notes'); ?></label>
    <div class='vra-element'>
        <?php $notes = $notesObject ? $notesObject->content : ''; ?>
        <textarea name='<?php echo $nameBase; ?>[notes][content]' value='<?php echo $notes; ?>'><?php echo $notes; ?></textarea>
        <div class='vra-attributes'>
            <label class='vra-attributes-label'>Notes Attributes</label>
            <?php echo $this->partial('element-attribute-form.php', 
                    array(
                         'attributeNames'   => $globalAttributes,
                         'attributeObjects' => $attributeObjects,
                         'nameBase'         => $nameBase . "[notes]"
                         )
                    );
            ?>
        </div>
    </div>

    <div class='vra-element'>
        <label class='vra-elements-label'><?php echo $omekaElement->name; ?> Subelements</label>
        <fieldset style='display: none;'>
            <input type='hidden' name='<?php echo $nameBase; ?>[newElements][0][name]' value='<?php echo $omekaElement->name; ?>'></input>
            <input type='hidden' name='<?php echo $nameBase; ?>[newElements][0][hasSubelements]' value='1'></input>
            <div class='vra-subelements'>
            <?php foreach($elementsData[$omekaElement->name]['subelements'] as $subelementName): ?>
                <div class='vra-subelement vra-element-inputs new'>
                <label class='vra-subelement-label'><?php echo $subelementName; ?></label>
                <textarea name='<?php echo $nameBase; ?>[newElements][0][newSubelements][<?php echo $subelementName; ?>][0][content]' value=''></textarea>
                    <?php if(! $ignoreAttributes): ?>
                        <div class='vra-attributes'>
                            <label class='vra-attributes-label'>Attributes</label>
                            <?php echo $this->partial('element-attribute-form.php', 
                                    array(
                                         'attributeNames'   => $attributeNames,
                                         'attributeObjects' => $attributeObjects,
                                         //kind of a cheat. put true at the front to produce a new set of attributes for new element
                                         'vraElementObjects' => array(true),
                                         'nameBase'         => $nameBase . "[newElements][0][newSubelements][" . $subelementName . "][0]",
                                         )
                                    );
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- insert the existing data: content and attributes -->
                <div class='vra-subelement existing'>
                <?php foreach($vraElementObjects as $vraElementObject): ?>
                    <?php if($vraElementObject->name == $subelementName): ?>
                        <div class='vra-element-inputs'>
                            <textarea name='<?php echo $nameBase; ?>[<?php echo $vraElementObject->id; ?>][content]' value='<?php echo $vraElementObject->content; ?>'><?php echo $vraElementObject->content; ?></textarea>
                            <?php if(! $ignoreAttributes): ?>
                                <div class='vra-attributes'>
                                <label class='vra-attributes-label'>Attributes</label>
                                <?php echo $this->partial('element-attribute-form.php', 
                                        array(
                                             'attributeNames'   => $attributeNames,
                                             'attributeObjects' => $attributeObjects,
                                             'vraElementObject' => $vraElementObject,
                                             'vraElementObjects' => $vraElementObjects,
                                             'nameBase'         => $nameBase . "[{$vraElementObject->id}]"
                                             )
                                        );
                                ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach;?>
                </div>
            <?php endforeach; ?>
            </div>
        </fieldset>
    </div>
</div>