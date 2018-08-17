# **************************************************
# Add the slider to the "New Content Element Wizard"
# **************************************************
mod.wizards.newContentElement.wizardItems.common {
	elements {
		fsc_slider_slick {
			iconIdentifier = content-image
			title = LLL:EXT:fsc_slider_slick/Resources/Private/Language/locallang_be.xlf:wizard.title
			description = LLL:EXT:fsc_slider_slick/Resources/Private/Language/locallang_be.xlf:wizard.description
			tt_content_defValues {
				CType = fsc_slider_slick
			}
		}
	}
	show := addToList(fsc_slider_slick)
}
# Hide backend fields options
TCEFORM.tt_content {
	layout {
		types {
			fsc_slider_slick {
				disabled = 0
				removeItems = 5,6,10,11,12
			}
		}
	}
}
